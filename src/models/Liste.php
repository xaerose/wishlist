<?php
namespace mywishlist\models;

class Liste extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'liste';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function items()
    {
        echo "test";
        return $this->hasMany('mywishlist\models\Item','liste_id');
    }
}