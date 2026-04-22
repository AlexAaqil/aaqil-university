<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TopicRequest extends FormRequest
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
        $topic = $this->route('topic');
        $ignore_id = null;

        if ($topic) {
            // route('topic') may be a model (route-model binding) or an id/uuid
            $ignore_id = is_object($topic) ? ($topic->id ?? null) : null;
        }

        return [
            'title' => [
                'required',
                'string',
                'max:80',
                Rule::unique('topics')
                    ->where('specialization_id', $this->input('specialization_id'))
                    ->ignore($ignore_id),
            ],
            'specialization_id' => 'required|exists:specializations,id',
            'sort_order' => 'nullable|numeric|min:1',
        ];
    }
}
