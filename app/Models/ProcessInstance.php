<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessInstance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'process_instance';

    public function process()
    {
        return $this->hasOne(Process::class, 'id', 'process_id');
    }

    public function orderStatus()
    {
        return $this->hasOne(ProcessInstanceStatus::class, 'id', 'process_instance_status_id');
    }
}
