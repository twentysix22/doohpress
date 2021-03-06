<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Jobinput;
use App\Sku;
use Auth;
use App\DoohpressLogger;


class JobsController extends Controller
{

    public function getList(Request $request) {
      $user = Auth::user();
        switch ($request->input('display')) {
          case 'myjobs':
            return $this->getJobsForUserOnTeam($user->id, $request->input('team_id'));
            break;
          case 'teamjobs':
            return $this->getJobsForTeam($request->input('team_id'));
            break;

          default:
            return array();
            break;
        }
    }

    private function getJobsForUserOnTeam($user_id, $team_id) {
      $jobs = Job::where('team_id','=',$team_id)
                  ->where('user_id','=',$user_id)
                  ->with([
                    'sku',
                    'sku.skutype',
                    'sku.composition.outputtype',
                    'sku.composition.compositioncategory',
                    'user'
                  ])
                  ->orderBy('created_at','desc')
                  ->get();
      return $jobs;
    }

    private function getJobsForTeam($team_id) {
      //1.check user is on team
      $user = Auth::user();
      if ($user->is_on_team($team_id)) {
        $jobs = Job::where('team_id','=',$team_id)
                    ->orderBy('created_at','desc')
                    ->with([
                      'sku',
                      'sku.skutype',
                      'sku.composition.outputtype',
                      'sku.composition.compositioncategory',
                      'user'
                    ])
                    ->get();
        return $jobs;
      } else {
        //user is not on the requested team
        return response('Invalid request', 422);
      }
    }




    //Handle submission of a job
    //
    //
    //
    public function submit(Request $request) {
      $job_data = json_decode($request->input('job'));
      $job = Job::find($job_data->id);
      if ($job) {
        DoohpressLogger::Job('debug',$job,'Job submitted');
        //
        //
        //
        //save job inputs
        foreach($job_data->wemockup_sku->product->inputoptions as $inputoption) {
          $jobinput = Jobinput::create([
            'job_id'=>$job->id,
            'inputoption_id'=>$inputoption->id,
            'input_type'=>$inputoption->input_type,
            'variable_name'=>$inputoption->variable_name,
            'value'=>$inputoption->value
          ]);
        }


        //queue processing of job
        $j = (new \App\Jobs\ProcessJobSubmission($job))->onQueue(env('QUEUE_JOBS'));
        dispatch($j);

        //mark as queued
        $job->markAsQueued();


        //return exactly same format of job UI expects
        return $this->getJob($job->id);

      } else {
        return response('Job not found', 404);
      }
    }




    public function createJob(Request $request) {
      $job_data = json_decode($request->input('job'));
      if ($this->isNewJobValid($job_data)) {
          //check if sku exists
          $sku = Sku::find($job_data->sku_id);
          if ($sku) {


            //construct new job
            $job = new Job;
            $job->team_id = $job_data->team_id;
            $job->user_id = Auth::user()->id;
            $job->sku_id = $sku->id;
            $job->status = 'PENDINGSETUP';

            if ($job->save()) {
              DoohpressLogger::Job('debug',$job,'Job created');
              return $job;
            } else {
              return response('Could not save job', 422);
            }

          } else {
            return response('Invalid sku', 422);
          }
      } else {
        return response('Invalid request', 422);
      }
    }


    //Check that new job data sent is valid
    //
    public function isNewJobValid($job) {
      return true;
    }





    //load the job
    //
    //
    public function getJob($job_id) {
        $jobs = Job::where('id','=',$job_id)->with([
          'sku',
          'sku.skutype',
          'sku.composition.outputtype',
          'sku.composition.compositioncategory',
          'sku.composition.frames'
        ])->get();
        if ($jobs->isNotEmpty()) {
          $job = $jobs[0];
          //
          //check that job belongs to a team that the user is on....
          if ($this->job_is_on_users_team($job)) {

            //if status PENDINGSETUP return the wemockup sku input items
            //
            //
            //
            if ($job->status == 'PENDINGSETUP') {
              $job->loadWemockupSku();
            }

            if ($job->status != 'CANCELLED' && $job->status != 'FAILED' && $job->status != 'PENDINGSETUP' && $job->status != 'QUEUED'  && $job->status != 'PROCESSING_MEDIA') {
              $job->loadWemockupItem();
            }

            return $job;

          } else {
            return response('Job not found on any of users teams.', 404);
          }
        } else {
          return response('Job not found', 404);
        }
    }


    //Checks that a Job belongs to a team that the user is on
    //
    //
    public function job_is_on_users_team(Job $job) {
      $user = Auth::user();
      foreach ($user->teams as $team) {
        if ($job->team_id == $team->id) {
          return true;
        }
      }
      return false;
    }

}
