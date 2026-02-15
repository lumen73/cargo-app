<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GestionnaireController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\GestionnaireDashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InspectionController;
use App\Http\Controllers\Admin\GestionnaireController as AdminGestionnaireController;
use App\Http\Controllers\MoyenController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ReceptionController;
use App\Http\Controllers\CargaisonController;
use App\Http\Controllers\ExpeditionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;
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


Route::get('/', function () {
    return view('auth/login');
})->name('login');

Route::resource('cargaisons', CargaisonController::class);

Route::resource('containers', ContainerController::class);

Route::resource('zones', ZoneController::class);

Route::resource('receptions', ReceptionController::class);

Route::resource('inspections', InspectionController::class);

Route::resource('expeditions', ExpeditionController::class);

//Route::get('/landing', function () {
//   $contacts = Contact::latest()->take(6)->get();
//   return view('landing', compact('contacts'));
//})->name('landing');


Route::get('/dashboard', function () {
    return view('landing');
})->name('dashboard');

Route::get('/contacts/index', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/all', [ContactController::class, 'all'])->name('contacts.all');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');;
//Route::get('/', [ContactController::class, 'landing']);
Route::get('/landing', [ContactController::class, 'index'])->name('landing');


Route::resource('moyens', MoyenController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin.gestionnaire'])->group(function () {
    Route::get('/gestionnaire', [GestionnaireController::class, 'updateRole']);
});

Route::get('/admin/gestionnaire', [AdminGestionnaireController::class, 'index'])->name('admin.gestionnaire.index');


//Route::middleware(['auth', 'role:admin'])->get('/gestionnaire/dashboard', [GestionnaireController::class, 'dashboard'])->name('gestionnaire.dashboard');

Route::post('/gestionnaire/store', [GestionnaireController::class, 'store'])->name('gestionnaire.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/landing', function () {
        return view('landing');
    });
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth', 'admin.gestionnaire'])->group(function () {
    Route::get('/gestionnaire/dashboard', [GestionnaireDashboardController::class, 'index'])->name('gestionnaire.dashboard');
});


//Route::middleware(['auth'])->group(function () {
// Route::get('/landing', function () {
// return view('landing');
//  });
//});



//Route::middleware(['auth', 'admin'])->group(function () {
// Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
//});


Route::middleware(['auth'])->group(function () {
    Route::post('/update-role', [RoleController::class, 'updateRole'])->name('update.role');
});

Route::resource('cargaisons', App\Http\Controllers\CargaisonController::class);

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
//Route::get('/gestionnaire/dashboard', [GestionnaireDashboardController::class, 'index'])->name('gestionnaire.dashboard');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', [AdminController::class, 'show'])->name('users.show');
Route::get('/admin/{id}/show', [AdminController::class, 'show'])->name('admin.show');
Route::get('/admin/{id}/details', [AdminController::class, 'show1'])->name('admin.show1');
Route::get('/admin/show2', [AdminController::class, 'indexGest'])->name('admin.show2');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    //Route::get('/landing', function () {
    //  return view('landing');
    // })->middleware('role:user');
});

require __DIR__ . '/auth.php';
