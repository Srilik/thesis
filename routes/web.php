<?php

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

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
                });

                // Thesis CRUD
                Route::controller(ThesisssController::class)->group(function () {
                    Route::get('/thesises/edit/{id}', 'editThesis')->name('thesises.edit');
                    //store and udpate
                    Route::post('/thesises/{id?}', 'storeThesis')->name('thesises.store');
                    Route::delete('/thesises/{id}', 'deleteThesis')->name('thesises.destroy');
                });

                // ThesisCommittee CRUD
                Route::controller(ThesisCommitteessController::class)->group(function () {
                    Route::get('/thesiscommittees/edit/{id}', 'editThesisCommittee')->name('thesiscommittees.edit');
                    //store or update
                    Route::post('/thesiscommittees/{id?}', 'storeThesisCommittee')->name('thesiscommittees.store');
                    Route::delete('/thesiscommittees/{id}', 'deleteThesisCommittee')->name('thesiscommittees.delete');
                });

                // ThesisStudent CRUD
                Route::controller(ThesisStudentssController::class)->group(function () {
                    Route::get('/thesisstudents/edit/{id}', 'edit')->name('thesisstudents.edit');
                    Route::post('/thesisstudents/{id?}', 'storeThesisStudent')->name('thesisstudents.store');
                    Route::delete('/thesisstudents/{id}', 'deleteThesisStudent')->name('thesisstudents.delete');
                });
            });
        });

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// show login page
Route::get('/login', [UserController::class, 'login'])
    ->middleware(RedirectToDashbordIfLoggedIn::class)
    ->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');
