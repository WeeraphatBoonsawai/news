<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WreathController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\NewsTypeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsFileController;
use App\Http\Controllers\FuneralNewsController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ViewNewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FuneralController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::resource('viewFuneral', FuneralController::class);

Route::get('/funerals/{id}', [FuneralController::class, 'show'])->name('viewFuneral.show');


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['auth', 'check.role:Admin,Editor'])->group(function () {
    Route::get('/funeral-news', [FuneralNewsController::class, 'index'])->name('funeral-news.index'); // แสดงรายการข่าวงานศพ
    Route::get('/funeral-news/create', [FuneralNewsController::class, 'create'])->name('funeral-news.create'); // หน้าสร้างข่าวงานศพ
    Route::post('/funeral-news', [FuneralNewsController::class, 'store'])->name('funeral-news.store'); // บันทึกข่าวงานศพใหม่
    Route::get('/funeral-news/{id}/edit', [FuneralNewsController::class, 'edit'])->name('funeral-news.edit'); // แก้ไขข่าวงานศพ
    Route::put('/funeral-news/{id}', [FuneralNewsController::class, 'update'])->name('funeral-news.update'); // บันทึกการแก้ไขข่าวงานศพ
    Route::delete('/funeral-news/{id}', [FuneralNewsController::class, 'destroy'])->name('funeral-news.destroy'); // ลบข่าวงานศพ

    Route::get('/wreath/upload', [WreathController::class, 'create'])->name('wreath.create');
    Route::post('/wreath/upload', [WreathController::class, 'store'])->name('wreath.store');
    Route::get('/wreath', [WreathController::class, 'index'])->name('wreath.index');
    Route::get('/wreath/{id}/edit', [WreathController::class, 'edit'])->name('wreath.edit');
    Route::put('/wreath/{id}', [WreathController::class, 'update'])->name('wreath.update');

    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news/create', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');

    Route::get('/admin', function () {
        return view('admin.index');
    });
    
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth', 'check.admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/update-status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
});

Route::resource('funeral_news', FuneralNewsController::class);
Route::post('notes', [NoteController::class, 'store'])->name('notes.store');
Route::delete('notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::delete('/news/files/{id}', [NewsFileController::class, 'destroy'])->name('news_file.destroy');

// โชว์ข้อมูลข่าวทั้งหมด
Route::get('/viewNews', [ViewNewsController::class, 'index'])->name('viewNews.index');

// โชว์รายละเอียดข่าวตาม ID
Route::get('/viewNews/{id}', [ViewNewsController::class, 'show'])->name('viewNews.show');

Route::get('/funeral-news/{id}', [HomeController::class, 'showFuneralNews'])->name('viewNews.funeralshow');

Route::resource('agency', AgencyController::class);
Route::resource('news_type', NewsTypeController::class);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
