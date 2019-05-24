<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'n_id';
    protected $table = 'newsfl';
    public $timestamps = false;
}
