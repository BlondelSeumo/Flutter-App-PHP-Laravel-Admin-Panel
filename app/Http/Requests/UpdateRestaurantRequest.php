<?php
/**
 * File name: UpdateRestaurantRequest.php
 * Last modified: 2020.04.30 at 08:21:08
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

namespace App\Http\Requests;

use App\Models\Restaurant;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $input = $this->all();

        $input['drivers'] = isset($input['drivers']) ? $input['drivers'] : [];

        if (auth()->user()->hasRole('admin')) {
            $input['users'] = isset($input['users']) ? $input['users'] : [];
            $input['cuisines'] = isset($input['cuisines']) ? $input['cuisines'] : [];
            $this->replace($input);
            return Restaurant::$adminRules;

        } else {
            unset($input['users']);
            unset($input['cuisines']);
            $this->replace($input);
            return Restaurant::$managerRules;
        }
    }
}
