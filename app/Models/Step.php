<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $table = 'step';

    public function process()
    {
        return $this->belongsToMany(Action::Process, 'id', 'process_id');
    }

    public function action()
    {
        return $this->belongsToMany(Action::class, 'id', 'action_id');
    }
}
