<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class movies extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'data_movies';
    public $timestamps = true;
}
