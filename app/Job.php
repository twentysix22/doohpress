<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Wemockup;
use Carbon\Carbon;

class Job extends Model
{
  protected $fillable = [
      'team_id',
      'user_id',
      'sku_id',
      'progress',
      'status',
      'date_processing_media',
      'date_rendering',
      'date_complete',
      'date_failed',
      'date_cancelled'
  ];



  public function team() {
    return $this->belongsTo('App\Team');
  }

  public function user() {
    return $this->belongsTo('App\User');
  }

  public function sku() {
    return $this->belongsTo('App\Sku');
  }

  public function jobinputs() {
    return $this->hasMany('App\Jobinput');
  }


  //Load the wemockup sku for this job
  //
  //
  //
  public function loadWemockupSku() {
    $wemockup = new Wemockup;
    $this->wemockup_sku = $wemockup->getSku($this->sku->wemockup_sku);

    //convert wemockup image data to doohpress compatible data
    foreach($this->wemockup_sku->product->inputoptions as $inputoption) {
        if ($inputoption->input_type == 'imageupload') {
          if ($inputoption->data->imagedimmin) {
            $dim = explode(',',$inputoption->data->imagedimmin);
            $inputoption->data->image_min_x = $dim[0];
            $inputoption->data->image_min_y = $dim[1];
          }

        }

    }


  }





  public function markAsQueued() {
    $this->status = 'QUEUED';
    $this->date_queued = Carbon::now();
    $this->save();
  }

  public function markAsProcessingMedia() {
    if ($this->status != 'PROCESSING_MEDIA') {
      $this->status = 'PROCESSING_MEDIA';
      $this->date_processing_media = Carbon::now();
      $this->save();
    }
  }



}
