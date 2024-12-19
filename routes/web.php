<?php

use Illuminate\Foundation\Application;
use Inertia\Inertia;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Thesis\ThesisManagement\ManagementController;
use App\Http\Controllers\ThesisAdvisorController;
use App\Http\Controllers\ThesisCommitteeController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisDetailController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\RedirectToDashbordIfLoggedIn;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Thesis\ThesisesController;

use App\Http\Controllers\Thesis\ThesisManagement\ThesisCommitteessController;
use App\Http\Controllers\Thesis\ThesisManagement\ThesisssController;
use App\Http\Controllers\Thesis\ThesisManagement\ThesisStudentssController;

use App\Http\Controllers\Attendance\AuthController;
use App\Http\Controllers\Attendance\StudentController;

use App\Http\Controllers\GroupThesisController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/allDashboard', function () {
    return redirect()->route('dashboard');
});

// Route::resource('group-theses', GroupThesisController::class);

Route::middleware('checkAuth')->group(function () {

    // thesis
    // Route::resource('/thesis', ThesisController::class);
    Route::prefix('/thesis')->controller(ThesisController::class)
        ->name('thesis.')
        ->group(function () {
            // list all thesis
            Route::get('/', 'index')->name('index');
            // create new thesis
            Route::get('/create', 'create')->name('create');
            //edit thesis
            Route::get('/edit/{id}', 'edit')->name('edit');
            //store new thesis
            Route::post('/store/{id?}', 'store')->name('store');
            //update thesis
            Route::put('/update/{id}', 'update')->name('update');
            //destroy thesis
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

    // thesisAdvisor
    // Route::resource('/thesisAdvisor', ThesisAdvisorController::class);
    Route::prefix('/thesisAdvisor')->controller(ThesisAdvisorController::class)
        ->name('thesisAdvisor.')
        ->group(function () {
            // list all thesisAdvisor
            Route::get('/', 'index')->name('index');
            // create new thesisAdvisor
            Route::get('/create', 'create')->name('create');
            //edit thesisAdvisor
            Route::get('/edit/{id}', 'edit')->name('edit');
            //store new thesisAdvisor
            Route::post('/store/{id?}', 'store')->name('store');
            //update thesisAdvisor
            Route::put('/update/{id}', 'update')->name('update');
            //destroy thesisAdvisor
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });


    // thesisCommittee
    // Route::resource('/thesisCommittee', ThesisCommitteeController::class);
    Route::prefix('/thesisCommittee')->controller(ThesisCommitteeController::class)
        ->name('thesisCommittee.')
        ->group(function () {
            // list all thesisCommittee
            Route::get('/', 'index')->name('index');
            // create new thesisCommittee
            Route::get('/create', 'create')->name('create');
            //edit thesisCommittee
            Route::get('/edit/{id}', 'edit')->name('edit');
            //store new thesisCommittee
            Route::post('/store/{id?}', 'store')->name('store');
            //update thesisCommittee
            Route::put('/update/{id}', 'update')->name('update');
            //destroy thesisCommittee
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });

    // thesisDetail
    // Route::resource('/thesisDetail', ThesisDetailController::class);
    Route::prefix('/thesisDetail')->controller(ThesisDetailController::class)
        ->name('thesisDetail.')
        ->group(function () {
            // list all thesisDetail
            Route::get('/', 'index')->name('index');
            // create new thesisDetail
            Route::get('/create', 'create')->name('create');
            //edit thesisDetail
            Route::get('/edit/{id}', 'edit')->name('edit');
            //store new thesisDetail
            Route::post('/store/{id?}', 'store')->name('store');
            //update thesisDetail
            Route::put('/update/{id}', 'update')->name('update');
            //destroy thesisDetail
            Route::delete('/destroy/{id}', 'destroy')->name('destroy');
        });


    Route::prefix('/thesises')
        ->middleware(['checkAuth'])
        ->name('thesises.')
        ->group(function () {
            // name:thesis.index
            Route::get('/', [ThesisesController::class, 'index'])->name('index');

            // Management dashboard
            Route::prefix('/management')
                ->name('management.')
                ->group(function () {
                // Management Page
                Route::controller(ManagementController::class)->group(function () {
                    Route::get('/', 'index')->name('index'); // Show inventory page
                    Route::get('/thesisSearch', 'index')->name('thesisSearch');
                });

                Route::get('/management/student/{id}', [ManagementController::class, 'getStudent'])
                    ->name('management.student');

                // Thesis CRUD
                Route::controller(ThesisssController::class)->group(function () {
                    Route::get('/thesises/edit/{id}', 'editThesis')->name('thesises.edit');
                    //store and udpate
                    Route::post('/thesises/{id?}', 'storeThesis')->name('thesises.store');
                    Route::delete('/thesises/{id}', 'deleteThesis')->name('thesises.delete');
                });

                // ThesisCommittee CRUD
                Route::controller(ThesisCommitteessController::class)->group(function () {
                    Route::get('/thesisCommittees/edit/{id}', 'editThesisCommittee')->name('thesisCommittees.edit');
                    //store or update
                    Route::post('/thesisCommittees/{id?}', 'storeThesisCommittee')->name('thesisCommittees.store');
                    Route::delete('/thesisCommittees/{id}', 'deleteThesisCommittee')->name('thesisCommittees.delete');
                });

                // ThesisStudent CRUD
                Route::controller(ThesisStudentssController::class)->group(function () {
                    Route::get('/thesisStudents/edit/{id}', 'edit')->name('thesisStudents.edit');
                    Route::post('/thesisStudents/{id?}', 'storeThesisStudent')->name('thesisStudents.store');
                    Route::delete('/thesisStudents/{id}', 'deleteThesisStudent')->name('thesisStudents.delete');
                });
            });
        });


    Route::prefix('/groupThesis')->controller(GroupThesisController::class)
        ->name('groupThesis.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/', 'store');
            Route::put('/{id}', 'update');
            Route::delete('/{id}', 'destroy');
        });

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// show login page
Route::get('/login', [UserController::class, 'login'])
    ->middleware(RedirectToDashbordIfLoggedIn::class)
    ->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');


// Route::get('/loginAttendance', [AuthController::class, 'showLoginForm'])
//     ->middleware(RedirectToDashbordIfLoggedIn::class)
//     ->name('login');
// Route::post('/loginAttendance', [AuthController::class, 'verifyLogin'])->name('verifyLogin');

// Route::middleware(['auth', 'role:student'])->group(function () {
//     Route::get('/student-dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
// });

// use App\Http\Controllers\Attendance\AdminController;
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     Route::resource('attendances', AdminController::class);
// });
