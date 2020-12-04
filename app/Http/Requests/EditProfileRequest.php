<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'email' => ['string', 'email', 'required', 'sometimes'],
            'password' => ['string', 'min:6', 'required', 'sometimes'],
            'nickname' => ['string', 'min:6', 'required', 'sometimes'],
            'name' => ['string', 'min:6', 'required', 'sometimes'],
            'path_to_avatar' => ['string', 'required', 'sometimes']
        ];
    }
}
