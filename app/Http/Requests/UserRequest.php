<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('post')) {
            // Rules for store method
            return [
                'name' => 'required|max:40',
                'email' => 'required|email|unique:users,email|max:150',
                'phone_number' => ['required', 'regex:/^(?:\+?\s?88|0088)?01[13-9]\d{8}$/', 'unique:users,phone_number'],
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'required|min:3|confirmed',
                'password_confirmation' => 'required|min:3',
            ];
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {

            $userId = $this->user->id;
            return [
                'name' => 'required|max:40',
                'email' => "required|email|max:150|unique:users,email,{$userId}",
                'phone_number' => ['required', 'regex:/^(?:\+?\s?88|0088)?01[13-9]\d{8}$/', "unique:users,phone_number,{$userId}"],
                'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'password' => 'nullable|min:3|confirmed',
                'password_confirmation' => 'nullable|min:3|required_with:password',
            ];
        }

        return [];
    }
}
