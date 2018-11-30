<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'action';

    public function getActions()
    {
        return $this->belongsToMany(Process::class);
    }
}
