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
                Rule::unique('specializations', 'title')
                    ->where('course_id', $this->input('course_id'))
                    ->ignore($specialization ? $specialization->id : null),
            ],
            'description' => 'nullable|string|max:2000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_published' => 'sometimes|boolean',
            'sort_order' => 'nullable|integer|min:1',
            'course_id' => [
                'required',
                'exists:courses,id',
            ],
        ];
    }
}
