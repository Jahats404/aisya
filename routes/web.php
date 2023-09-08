<?php

use App\Http\Controllers\AkependudukanController;
use App\Http\Controllers\AkesehatanController;
use App\Http\Controllers\ApendidikanController;
use App\Http\Controllers\ApribadiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\Akependudukan;
use App\Models\Akesehatan;
use App\Models\Apendidikan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/maps', function () {
    return view('admin.maps');
});
Route::get('/map', function () {
    return view('admin.map');
});
Route::get('/', [LoginController::class, 'page']);

Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('register/action', [UserController::class, 'actionregister'])->name('actionregister');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/actionlogin', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::post('/getkecamatan', [UserController::class, 'getkecamatan'])->name('getkecamatan');
Route::get('logout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('/error', [LoginController::class, 'error'])->name('error');

Route::post('/process-data', [DashboardController::class, 'processData']);
Route::get('/get-states/{country_id}', 'WilayahController@getStates');



// Route::prefix('admin')->middleware('isAdmin')->group(function () {
//     Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('a.dashboard');
//     Route::post('/daftar-desa',[DashboardController::class, 'kode'])->name('kode.wilayah');
// });


Route::prefix('masyarakat')->middleware('isMasyarakat')->group(function () {
    // ========================================== DASHBOARD ==========================================
    Route::get('dashboard', [DashboardController::class, 'dashboardM'])->name('m.dashboard');
    // ========================================== PROFILE ==========================================
    Route::get('/profile', [UserController::class, 'profile'])->name('m.profile');
    Route::get('api', [DashboardController::class, 'index'])->name('m.api');
    Route::put('/profile-update',[UserController::class, 'update_profile'])->name('m.update-profile');
    Route::put('/password-update',[UserController::class, 'update_password'])->name('m.update-password');
    Route::post('/fotodir-update',[UserController::class, 'update_fotodir'])->name('m.update-fotodir');
    Route::post('/foto-update',[UserController::class, 'update_foto'])->name('m.update-foto');
    // ========================================== ARPEN ==========================================
    Route::get('form-arpen',[ApendidikanController::class, 'form_arpen'])->name('m.form-arpen');
    Route::post('arpen/store',[ApendidikanController::class, 'arpen_store'])->name('m.arpen-store');
    Route::get('table-arpen',[ApendidikanController::class, 'table_arpen'])->name('m.table-arpen');
    Route::put('/arpen-update/{id_arpen}',[ApendidikanController::class, 'update_arpen'])->name('m.update-arpen');
    Route::delete('/delete-arpen/{id_arpen}', [ApendidikanController::class, 'destroy'])->name('m.delete-arpen');

    // ========================================== ARKEP ==========================================
    Route::get('form-arkep',[AkependudukanController::class, 'form_arkep'])->name('m.form-arkep');
    Route::post('arkep/store',[AkependudukanController::class, 'arkep_store'])->name('m.arkep-store');
    Route::get('table-arkep',[AkependudukanController::class, 'table_arkep'])->name('m.table-arkep');
    Route::put('/arkep-update/{id_arkep}',[AkependudukanController::class, 'update_arkep'])->name('m.update-arkep');
    Route::delete('/delete-arkep/{id_arkep}', [AkependudukanController::class, 'destroy'])->name('m.delete-arkep');
    // ========================================== ARKES ==========================================
    Route::get('form-arkes',[AkesehatanController::class, 'form_arkes'])->name('m.form-arkes');
    Route::post('arkes/store',[AkesehatanController::class, 'arkes_store'])->name('m.arkes-store');
    Route::get('table-arkes',[AkesehatanController::class, 'table_arkes'])->name('m.table-arkes');
    Route::put('/arkes-update/{id_arkes}',[AkesehatanController::class, 'update_arkes'])->name('m.update-arkes');
    Route::delete('/delete-arkes/{id_arkes}', [AkesehatanController::class, 'destroy'])->name('m.delete-arkes');
    // ========================================== ARPRI ==========================================
    Route::get('form-arpri',[ApribadiController::class, 'form_arpri'])->name('m.form-arpri');
    Route::post('arpri/store',[ApribadiController::class, 'arpri_store'])->name('m.arpri-store');
    Route::get('table-arpri',[ApribadiController::class, 'table_arpri'])->name('m.table-arpri');
    Route::put('/arpri-update/{id_arpri}',[ApribadiController::class, 'update_arpri'])->name('m.update-arpri');
    Route::delete('/delete-arpri/{id_arpri}', [ApribadiController::class, 'destroy'])->name('m.delete-arpri');
});

Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'dashboardA'])->name('a.dashboard');
    Route::get('/daftar-masyarakat',[DashboardController::class, 'totMasyarakat'])->name('a.totMasyarakat');
    Route::post('/daftar-desa',[DashboardController::class, 'kode'])->name('kode.wilayah');
    // ========================================== DETAIL MAPS ==========================================
    Route::get('/desa-Adipala',[DashboardController::class, 'Adipala'])->name('adipala');
    Route::get('/desa-Kesugihan',[DashboardController::class, 'Kesugihan'])->name('kesugihan');
    Route::get('/desa-Dayeuhluhur',[DashboardController::class, 'Dayeuhluhur'])->name('Dayeuhluhur');
    Route::get('/desa-Wanareja',[DashboardController::class, 'Wanareja'])->name('Wanareja');
    Route::get('/desa-Majenang',[DashboardController::class, 'Majenang'])->name('Majenang');
    Route::get('/desa-Cimanggu',[DashboardController::class, 'Cimanggu'])->name('Cimanggu');
    Route::get('/desa-Cipari',[DashboardController::class, 'Cipari'])->name('Cipari');
    Route::get('/desa-Karangpucung',[DashboardController::class, 'Karangpucung'])->name('Karangpucung');
    Route::get('/desa-Sidareja',[DashboardController::class, 'Sidareja'])->name('Sidareja');
    Route::get('/desa-Kedungreja',[DashboardController::class, 'Kedungreja'])->name('Kedungreja');
    Route::get('/desa-Gandrungmangu',[DashboardController::class, 'Gandrungmangu'])->name('Gandrungmangu');
    Route::get('/desa-Patimuan',[DashboardController::class, 'Patimuan'])->name('Patimuan');
    Route::get('/desa-Bantarsari',[DashboardController::class, 'Bantarsari'])->name('Bantarsari');
    Route::get('/desa-Kampunglaut',[DashboardController::class, 'Kampunglaut'])->name('Kampunglaut');
    Route::get('/desa-Kawunganten',[DashboardController::class, 'Kawunganten'])->name('Kawunganten');
    Route::get('/desa-Jeruklegi',[DashboardController::class, 'Jeruklegi'])->name('Jeruklegi');
    Route::get('/desa-Cilacaptengah',[DashboardController::class, 'Cilacaptengah'])->name('Cilacaptengah');
    Route::get('/desa-Nusakambangan',[DashboardController::class, 'Nusakambangan'])->name('Nusakambangan');
    Route::get('/desa-Cilacaputara',[DashboardController::class, 'Cilacaputara'])->name('Cilacaputara');
    Route::get('/desa-Maos',[DashboardController::class, 'Maos'])->name('Maos');
    Route::get('/desa-Sampang',[DashboardController::class, 'Sampang'])->name('Sampang');
    Route::get('/desa-Kroya',[DashboardController::class, 'Kroya'])->name('Kroya');
    Route::get('/desa-Binangun',[DashboardController::class, 'Binangun'])->name('Binangun');
    Route::get('/desa-Nusawungu',[DashboardController::class, 'Nusawungu'])->name('Nusawungu');
});