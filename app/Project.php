<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'assign_id',
        'user_id',
        'amount',
        'project_type'
        
    ];
}
