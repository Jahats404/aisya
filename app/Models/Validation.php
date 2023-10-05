<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules;

class Validation extends Model
{
    use HasFactory;

    public static $rules = [
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required', 'confirmed',
    ];

    public static $message = [
        'token.required' => 'Harus ada token',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Email tidak valid',
        'password.required' => 'Password harus diisi',
        'password.cofirmed' => 'Password tidak valid',
    ];
}
