<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'action';

    public function process()
    {
        return $this->belongsToMany(Process::class);
    }
}
