<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentRequest extends FormRequest
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
            'rooms' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required',
            'cover' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'services' => 'required',
            'price' => 'nullable',
            'description' => 'nullable',
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Il campo Titolo è obbligatorio',
            'rooms.required' => 'Inserire il numero di stanze totali',
            'rooms.integer' => 'Inserire un numero intero',
            'rooms.min' => 'Non inserire numeri negativi',
            'bedrooms.required' => 'Inserire il numero di stanze da letto',
            'bedrooms.integer' => 'Inserire un numero intero',
            'bedrooms.min' => 'Non inserire numeri negativi',
            'bathrooms.required' => 'Inserire il numero di bagni',
            'bathrooms.integer' => 'Inserire un numero intero',
            'bathrooms.min' => 'Non inserire numeri negativi',
            'square_meters.required' => 'Metri quadri richiesti',
            'square_meters.integer' => 'Inserire un numero intero',
            'square_meters.min' => 'Non inserire numeri negativi',
            'address.required' => "Inserire l'indirizzo",
            'services.required' => 'Inserisci almeno un campo in Servizi',
            'cover.image' => 'La cover deve essere un immagine',
            'cover.mimes' => 'Il formato deve essere: jpeg, png, jpg, gif',
            'cover.max' => 'Grandezza massima di 2MB'
        ];
    }
}
