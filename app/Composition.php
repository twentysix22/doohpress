<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{

  protected $fillable = [
      'name',
      'description',
      'outputtype_id',
      'compositioncategory_id',
      'latitude',
      'longitude',
      'published',
      'image',
      'thumbnail',
      'wemockup_product_id'
  ];

    public function frames() {
      return $this->belongsToMany('App\Frame');
    }

    public function outputtype() {
      return $this->belongsTo('App\Outputtype');
    }

    public function compositioncategory() {
      return $this->belongsTo('App\compositioncategory');
    }

    public function skus() {
      return $this->hasMany('App\Sku')->orderBy('priority');;
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function examples() {
      return $this->hasMany('App\Example');
    }

    public function preprocesses() {
      return $this->hasMany('App\Preprocess');
    }



}
