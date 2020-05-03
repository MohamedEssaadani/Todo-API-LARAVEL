<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //To allow assignments
    protected $fillable = ['title', 'completed'];

    //To hide fileds from array or returned json
    protected $hidden = ['created_at', 'updated_at'];
}
