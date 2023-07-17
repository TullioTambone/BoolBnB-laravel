<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', Rule::unique('apartments')->ignore($this->apartment)],
            'rooms' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'square_meters' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
            'description' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2000',
            'services' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'title.unique' => 'il titolo è gia stato inserito',
            'title.required' => 'Il campo titolo è obbligatorio',
            'rooms.required' => 'Inserire il numero di stanze totali',
            'bedrooms.required' => 'Inserire il numero di stanze da letto',
            'bathrooms.required' => 'Inserire il numero di bagni',
            'square_meters.required' => 'Metri quadri richiesti',
            'address.required' => "Inserire l'indirizzo",
            'description.required' => 'La descrizione è obbligatoria',
            'price.required' => 'Inserire un prezzo',
            'services.required' => 'inserisci almeno un campo'
        ];
    }
}
