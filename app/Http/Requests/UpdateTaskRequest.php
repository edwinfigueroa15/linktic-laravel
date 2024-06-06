<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
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
        $method = $this->method();
        if($method == 'PUT') {
            return [
                'title' => ['required'],
                'description' => ['required'],
                'status' => [Rule::in(['pending', 'in_progress', 'completed'])],
                'due_date' => ['required'],
                'user_id' => ['required'],
            ];
        } else {
            return [
                'title' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
                'status' => ['sometimes', Rule::in(['pending', 'in_progress', 'completed'])],
                'due_date' => ['sometimes', 'required'],
                'user_id' => ['sometimes', 'required'],
            ];
        }
        
    }
}
