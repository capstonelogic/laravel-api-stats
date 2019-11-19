<?php

namespace CapstoneLogic\Stats\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $tablePrefix = config('capstonelogic.stats.db_prefix');

        return [
            
        ];
    }
}
