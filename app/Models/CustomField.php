<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class CustomField
 * @package App\Models
 * @version July 24, 2018, 9:13 pm UTC
 *
 * @property string name
 * @property string type
 * @property boolean disabled
 * @property boolean required
 * @property boolean in_table
 * @property tinyInteger bootstrap_column
 * @property tinyInteger order
 * @property string custom_field_model
 */
class CustomField extends Model
{

    public $table = 'custom_fields';
    


    public $fillable = [
        'name',
        'type',
        'values',
        'disabled',
        'required',
        'in_table',
        'bootstrap_column',
        'order',
        'custom_field_model'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'type' => 'string',
        'values' => 'array',
        'disabled' => 'boolean',
        'required' => 'boolean',
        'in_table' => 'boolean',
        'custom_field_model' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'type' => 'required',
        'bootstrap_column' => 'min:1|max:12',
        'custom_field_model' => 'required'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        
    ];

    
    
}
