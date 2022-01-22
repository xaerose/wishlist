<?php

namespace mywishlist\models;

class Item extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'item';
    protected $primaryKey = 'id';
	protected $nom = 'nom';
	protected $descr = 'descr';
	protected $url = 'url';
	protected $tarif = 'tarif';
    public $timestamps = false;

    public function liste()
    {
        return $this->belongsTo('mywishlist\models\Liste', 'liste_id');
    }
}