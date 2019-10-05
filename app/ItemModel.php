<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemModel extends Model
{
    use SoftDeletes;

    protected $fillable = ['model_name'];
}
