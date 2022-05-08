<?php

namespace Toshkq93\Logger\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Toshkq93\Logger\Filters\DataFilter;

class ShowLogRequest extends FormRequest
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
        return [
            'method' => [
                'nullable',
                'string'
            ],
            'method_status' => [
                'nullable',
                'integer'
            ],
            'date_start' => [
                'date',
                'nullable'
            ],
            'date_end' => [
                'date',
                'nullable'
            ],
            'user_id' => [
                'nullable',
                'integer'
            ],
            'controller' => [
                'nullable',
                'string'
            ],
            'dir_name' => [
                'nullable',
                'string'
            ]
        ];
    }

    /**
     * @return DataFilter
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getFilterDTO(): DataFilter
    {
        return new DataFilter(
            $this->validated()
        );
    }
}
