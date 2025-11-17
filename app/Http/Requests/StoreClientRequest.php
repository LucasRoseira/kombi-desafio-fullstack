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
            'phone' => ['nullable','string','max:20'],
            'cpf' => ['nullable','string','max:14','unique:clients,cpf', new \App\Rules\Cpf],
            'cnpj' => ['nullable','string','max:18','unique:clients,cnpj', new \App\Rules\Cnpj],
            'cep' => ['nullable','string','max:10'],
            'state_id' => ['nullable','integer','exists:states,id'],
            'city_id' => ['nullable','integer','exists:cities,id'],
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:50',
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
