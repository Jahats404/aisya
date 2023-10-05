<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'tanggal_lahir',
        'nik',
        'kk',
        'no_hp',
        'email',
        'password',
        'url',
        'role_id',
        'kecamatan',
        'desa',
        'remember_token'
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'nik' => 'required|unique:users,nik|digits:16|regex:/^3301/',
        'tanggal_lahir' => 'required',
        'kk' => 'required',
        'kecamatan' => 'required',
        'desa' => 'required',
        'email' => 'required|email|unique:users,email',
        'no_hp' => 'required',
        'password' => 'required|string|min:6',
    ];

    public static $messages = [
        'name.required' => 'Nama harus diisi.',
        'name.max' => 'Nama tidak boleh lebih dari :max karakter.',
        'nik.required' => 'NIK harus diisi.',
        'nik.unique' => 'NIK Sudah Terdaftar.',
        'nik.digits' => 'NIK harus terdiri dari :digits digit.',
        'nik.regex' => 'NIK harus berdomisili Cilacap.',
        'tanggal_lahir.required' => 'Tanggal Lahir harus diisi.',
        'kk.required' => 'KK harus diisi.',
        'kecamatan.required' => 'Kecamatan Harus diisi.',
        'desa' => 'Desa harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Email tidak valid.',
        'email.unique' => 'Email sudah terdaftar.',
        'no_hp.required' => 'Nomor Telepon harus diisi',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal :min karakter.',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRedirectRoute()
    {
        return match((int)$this->role_id) {
            1 => route('a.admin'),
            2 => route('m.admin'),
            default => route('default.dashboard'), // Ganti 'default.dashboard' dengan rute default yang sesuai
        };
    }


    public function roles(){
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function apendidikan(){
        return $this->hasMany(Apendidikan::class, 'user_id','id');
    }
    public function akependudukan(){
        return $this->hasMany(Akependudukan::class, 'user_id','id');
    }
    public function akesehatan(){
        return $this->hasMany(Akesehatan::class, 'user_id','id');
    }
    public function apribadi(){
        return $this->hasMany(Apribadi::class, 'user_id','id');
    }
}
