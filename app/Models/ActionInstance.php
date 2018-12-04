<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionInstance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'action_instance';

    public function action()
    {
        return $this->hasOne(Action::class, 'id', 'action_id');
    }

    public function actionStatus()
    {
        return $this->hasOne(ActionInstanceStatus::class, 'id', 'action_instance_status_id');
    }
}
