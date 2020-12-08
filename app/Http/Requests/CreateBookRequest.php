<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookRequest extends FormRequest
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
            'title' => ['string', 'min:3', 'required'],
            'author' => ['string', 'min:6', 'required'],
            'genre' => ['string', 'min:5', 'required'],
            'description' => ['string', 'min:6', 'required'],
            'cover' => ['required', 'mimetypes:image/png,image/jpeg'],
            'path_to_book' => ['required', 'mimetypes:text/plain,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword'],


        ];
    }
}
