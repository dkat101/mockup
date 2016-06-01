<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'p_id';

    /**
     * Indicates if p_id is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
