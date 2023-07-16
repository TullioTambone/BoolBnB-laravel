<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'title' => 'required',
            'rooms' => 'required',
            'bedrooms' => 'required',
            'bathrooms' => 'required',
            'square_meters' => 'required',
            'address' => 'required',
            'description' => 'required',
            'price' => 'required',
            'description' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2000'
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Il campo titolo è obbligatorio',
            'rooms.required' => 'Inserire il numero di stanze totali',
            'bedrooms.required' => 'Inserire il numero di stanze da letto',
            'bathrooms.required' => 'Inserire il numero di bagni',
            'square_meters.required' => 'Metri quadri richiesti',
            'address.required' => "Inserire l'indirizzo",
            'description.required' => 'La descrizione è obbligatoria',
            'price.required' => 'Inserire un prezzo',
        ];
    }
}