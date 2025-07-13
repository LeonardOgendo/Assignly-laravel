<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // Only logged-in users
    }

    public function rules(): array
    {
        return [
            'title'       => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline'    => ['nullable', 'date', 'after_or_equal:today'],
            'status'      => ['sometimes', 'in:pending,in_progress,completed'],
        ];
    }
}
