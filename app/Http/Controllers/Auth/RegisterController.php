<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // return Validator::make($data, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);

        return $validator = Validator::make($data, User::$rules, User::$messages);
        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        //untuk mengambil kode desa yang di inputkan
        $kodeDesa = $data['desa'];
        $kodeKecamatan = $data['kecamatan'];

        // mengambil nama kecamatan berdasarkan kode
        $namakecamatan = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeKecamatan)
                ->get();
        // mengambil nama kecamatan berdasarkan kode
        $namaDesa = DB::table('wilayah')
                ->select('nama')
                ->where('kode', $kodeDesa)
                ->get();
        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'nik' => $data['nik'],
            'kecamatan' => $namakecamatan[0]->nama,
            'desa' => $namaDesa[0]->nama,
            'role_id' => 2,
            'kk' => $data['kk'],
            'no_hp' => $data['no_hp'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
