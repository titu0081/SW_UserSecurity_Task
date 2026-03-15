<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'id_task';

    protected $fillable = ['title', 'description', 'completed', 'limit_date', 'id_user'];

    protected $casts = [
        'completed' => 'boolean',
        'limit_date' => 'datetime',
    ];
}
