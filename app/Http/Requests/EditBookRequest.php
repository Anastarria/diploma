<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBookRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['string', 'min:3', 'sometimes'],
            'author' => ['string', 'min:6', 'sometimes'],
            'genre' => ['string', 'min:5', 'sometimes'],
            'description' => ['string', 'min:6', 'sometimes'],
            'cover' => ['sometimes'],
            'path_to_book' => ['sometimes'],
        ];
    }
}
