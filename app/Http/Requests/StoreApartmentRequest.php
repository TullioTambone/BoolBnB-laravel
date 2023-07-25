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
            'rooms' => 'required|integer|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'square_meters' => 'required|integer|min:0',
            'address' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'services' => 'required'
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'Il campo Titolo è obbligatorio',
            'title.unique' => 'Questo Titolo è già presente',
            'rooms.required' => 'Inserire il numero di Stanze totali',
            'rooms.integer' => 'Inserire un numero intero',
            'rooms.min' => 'Non inserire numeri negativi',
            'bedrooms.required' => 'Inserire il numero di Camere da letto',
            'bedrooms.integer' => 'Inserire un numero intero',
            'bedrooms.min' => 'Non inserire numeri negativi',
            'bathrooms.required' => 'Inserire il numero di Bagni',
            'bathrooms.integer' => 'Inserire un numero intero',
            'bathrooms.min' => 'Non inserire numeri negativi',
            'square_meters.required' => 'Metri Quadri richiesti',
            'square_meters.integer' => 'Inserire un numero intero',
            'square_meters.min' => 'Non inserire numeri negativi',
            'address.required' => "Inserire l'Indirizzo",
            'services.required' => 'Inserisci almeno un campo in Servizi',
            'cover.image' => 'La cover deve essere un immagine',
            'cover.mimes' => 'Il formato deve essere: jpeg, png, jpg, gif',
            'cover.max' => 'Grandezza massima di 2MB',
            'cover.required' => 'Il campo Immagine Principale è richiesto'
        ];
    }
}
