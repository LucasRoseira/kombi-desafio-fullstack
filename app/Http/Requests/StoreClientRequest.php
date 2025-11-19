<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => ['required','email','max:255', Rule::unique('clients','email')],
            'phone' => ['required','string','max:20'],
            'cpf' => ['nullable','string','max:14','unique:clients,cpf', new \App\Rules\Cpf],
            'cnpj' => ['required','string','max:18','unique:clients,cnpj', new \App\Rules\Cnpj],
            'cep' => ['required','string','max:10'],
            'state' => ['required','string','max:100'],
            'city' => ['required','string','max:100'],
            'street' => 'required|string|max:255',
            'number' => 'required|string|max:50',
            'complement' => 'nullable|string|max:255',
            'agreed' => 'required|boolean'
        ];
    }

    protected function prepareForValidation()
    {

        $this->merge([
            'cpf' => $this->cpf ? preg_replace('/\D/','',$this->cpf) : null,
            'cnpj' => $this->cnpj ? preg_replace('/\D/','',$this->cnpj) : null,
            'phone' => $this->phone ? preg_replace('/\D/','',$this->phone) : null,
            'cep' => $this->cep ? preg_replace('/\D/','',$this->cep) : null,
            'agreed' => filter_var($this->agreed, FILTER_VALIDATE_BOOLEAN),
        ]);
    }
}
