<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'i_id';

    /**
     * Indicates if p_id is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

}
