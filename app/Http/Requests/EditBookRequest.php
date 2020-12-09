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
            'description' => ['string', 'min:50', 'sometimes'],
            'cover' => ['sometimes', 'mimetypes:image/png,image/jpeg'],
            'path_to_book' => ['sometimes', 'required', 'mimetypes:text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'],
        ];
    }
}
