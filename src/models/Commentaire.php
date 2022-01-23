<?php

namespace mywishlist\models;

class Commentaire extends \Illuminate\Database\Eloquent\Model {

    protected $table = 'commentaire';
    protected $primaryKey = 'index' ;
    public $timestamps = false;

    public function liste(){
        return $this->belongsTo('mywishlist\models\Liste', 'liste_id');
    }

}
