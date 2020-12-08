<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Earning
 * @package App\Models
 * @version March 25, 2020, 9:48 am UTC
 *
 * @property \App\Models\Restaurant restaurant
 * @property integer restaurant_id
 * @property integer total_orders
 * @property double total_earning
 * @property double admin_earning
 * @property double restaurant_earning
 * @property double delivery_fee
 * @property double tax
 */
class Earning extends Model
{

    public $table = 'earnings';
    


    public $fillable = [
        'restaurant_id',
        'total_orders',
        'total_earning',
        'admin_earning',
        'restaurant_earning',
        'delivery_fee',
        'tax'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'restaurant_id' => 'integer',
        'total_orders' => 'integer',
        'total_earning' => 'double',
        'admin_earning' => 'double',
        'restaurant_earning' => 'double',
        'delivery_fee' => 'double',
        'tax' => 'double'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'restaurant_id' => 'required|exists:restaurants,id'
    ];

    /**
     * New Attributes
     *
     * @var array
     */
    protected $appends = [
        'custom_fields',
        
    ];

    public function customFieldsValues()
    {
        return $this->morphMany('App\Models\CustomFieldValue', 'customizable');
    }

    public function getCustomFieldsAttribute()
    {
        $hasCustomField = in_array(static::class,setting('custom_field_models',[]));
        if (!$hasCustomField){
            return [];
        }
        $array = $this->customFieldsValues()
            ->join('custom_fields','custom_fields.id','=','custom_field_values.custom_field_id')
            ->where('custom_fields.in_table','=',true)
            ->get()->toArray();

        return convertToAssoc($array,'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function restaurant()
    {
        return $this->belongsTo(\App\Models\Restaurant::class, 'restaurant_id', 'id');
    }
    
}
