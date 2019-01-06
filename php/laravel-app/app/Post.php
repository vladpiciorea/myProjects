<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name -- schimba numele tabelului
    protected $table = 'posts';
    // Primary key -- schimba primary key
    // protected $primaryKey = 'item_id';
    // Timestamps
    // public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }
 }
