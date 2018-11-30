<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'process';
    protected $dates = ['created'];

    public function getActions()
    {
        return $this->belongsToMany(Action::class, 'step', 'process_id', 'step');
    }
}
