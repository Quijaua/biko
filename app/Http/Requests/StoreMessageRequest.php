<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->allowed_send_email;
    }

    protected function prepareForValidation()
    {
        $nucleos = collect($this->nucleos);
        if ($nucleos->first() === 'null') {
            $this->merge(['nucleos' => null]);
            $this->merge(['alunos' => null]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nucleos' => 'nullable',
            'alunos' => 'nullable',
            'titulo' => 'required|string',
            'mensagem' => 'required|string',
        ];
    }
}
