<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // 這個方法用來決定當前用戶是否被授權發送此請求。
        // 在這個示例中，簡單地返回 true，表示所有用戶都被授權。
        // 如果您需要更細粒度的授權控制，可以在這裡添加自定義邏輯。
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
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ];
    }
}
