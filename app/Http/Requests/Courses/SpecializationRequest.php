<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecializationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $specialization = $this->route('specialization');

        return [
            'title' => [
                'required',
                'string',
                'max:80',
                Rule::unique('specializations', 'title')->ignore(optional($specialization)->id),
            ],
            'courses' => 'required|array|min:1',
            'courses.*' => 'exists:courses,id',
            'sort_order' => 'nullable|array',
            'sort_order.*' => 'nullable|numeric|min:1',
        ];
    }
}
