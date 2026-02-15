<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AdminController,
    GestionnaireController,
    UserController,
    UserDashboardController,
    GestionnaireDashboardController,
    ProfileController,
    InspectionController,
    MoyenController,
    ContainerController,
    ZoneController,
    ReceptionController,
    CargaisonController,
    ExpeditionController,
    ContactController,
    RoleController,
    LandingController
};
use App\Http\Controllers\Admin\GestionnaireController as AdminGestionnaireController;

// Page de connexion
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Accueil utilisateur
//Route::get('/landing', [ContactController::class, 'index'])->name('landing');
Route::middleware('auth')->group(function () {
    Route::get('/landing', [LandingController::class, 'index'])->name('landing');
});
// Dashboard principal (optionnel)
Route::get('/dashboard', function () {
    return view('landing');
})->name('landing');

// Contacts
Route::get('/contacts/index', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/all', [ContactController::class, 'all'])->name('contacts.all');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::get('/contacts/index', [LandingController::class, 'index'])->name('contacts.index');
Route::get('/contacts/index', [UserDashboardController::class, 'index'])->name('contacts.index');

// Ressources
Route::resources([
    'cargaisons' => CargaisonController::class,
    'containers' => ContainerController::class,
    'zones' => ZoneController::class,
    'receptions' => ReceptionController::class,
    'inspections' => InspectionController::class,
    'expeditions' => ExpeditionController::class,
    'moyens' => MoyenController::class,
]);

// Routes protégées par 'auth'
Route::middleware('auth')->group(function () {

    // Gestion du profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mise à jour du rôle
    Route::post('/update-role', [RoleController::class, 'updateRole'])->name('update.role');

    // Dashboard utilisateur
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // Dashboard gestionnaire
    Route::middleware('admin.gestionnaire')->group(function () {

        Route::get('/gestionnaire', [GestionnaireController::class, 'updateRole']); // route sans nom ?
    });

    // Dashboard admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

        // Gestion utilisateurs
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/{id}/update-role', [UserController::class, 'updateRole'])->name('users.updateRole');

        // Gestion gestionnaires (côté admin)
        Route::get('/admin/gestionnaire', [AdminGestionnaireController::class, 'index'])->name('admin.gestionnaire.index');
        Route::post('/gestionnaire/store', [GestionnaireController::class, 'store'])->name('gestionnaire.store');

        // Détails utilisateurs/admins
        Route::get('/users/{id}', [AdminController::class, 'show'])->name('users.show');
        Route::get('/admin/{id}/show', [AdminController::class, 'show'])->name('admin.show');
        Route::get('/admin/{id}/details', [AdminController::class, 'show1'])->name('admin.show1');
        Route::get('/admin/show2', [AdminController::class, 'indexGest'])->name('admin.show2');
        Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.update');
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// Auth routes (Breeze/Fortify/etc.)
require __DIR__ . '/auth.php';
