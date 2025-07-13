<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        // TaskPolicy handles final check in the controller.
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,in_progress,completed',
        ];
    }
}
