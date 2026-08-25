<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => [
                'nullable',
                'string',
                'max:255',
            ],

            'category' => [
                'nullable',
                'integer',
                'exists:categories,id',
            ],

            'status' => [
                'nullable',
                'in:pending,in_progress,completed',
            ],

            'priority' => [
                'nullable',
                'in:low,medium,high',
            ],

            'due_date_filter' => [
                'nullable',
                'in:overdue,today,upcoming',
            ],

            'sort' => [
                'nullable',
                'in:newest,oldest,due_soonest',
            ],
        ];
    }
}
