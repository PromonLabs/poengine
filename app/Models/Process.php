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
    public $timestamps = false;

    public function actions()
    {
        return $this->belongsToMany(Action::class);
    }

    public function getActions()
    {
        return $this->belongsToMany(Action::class, 'step', 'process_id', 'action_id')->orderBy('step', 'asc');
    }

    public function scopeNameSearch($query, $processFilter)
    {
        return $query->where('name', 'like', '%'.$processFilter.'%');
    }

    public function scopeDescriptionSearch($query, $processFilter)
    {
        return $query->orWhere('description', 'like', '%'.$processFilter.'%');
    }
}
