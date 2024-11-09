<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThesisAdvisorController;
use App\Http\Controllers\ThesisCommitteeController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisDetailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectToDashbordIfLoggedIn;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('checkAuth')->group(function () {

    // // thesis
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

    // // thesisAdvisor
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

<<<<<<< HEAD
    // thesisAdvisor
    // Route::resource('/thesisAdvisor', ThesisAdvisorController::class);
    Route::prefix('/thesisAdvisor')->controller(ThesisAdvisorController::class)
    ->name('thesisAdvisor.')
    ->group(function () {
        // your code here
        // list thesisAdvisor and create or edit form

        Route::get('/', 'index')->name('index');

        // store or update thesisAdvisor
        Route::post('/store/{id?}', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');

        // delete thesisAdvisor
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });
=======
>>>>>>> main

    // thesisCommittee
    // Route::resource('/thesisCommittee', ThesisCommitteeController::class);
    Route::prefix('/thesisCommittee')->controller(ThesisCommitteeController::class)
<<<<<<< HEAD
    ->name('thesisCommittee.')
    ->group(function () {
        // your code here
        // list thesisCommittee and create or edit form

        Route::get('/', 'index')->name('index');

        // store or update thesisCommittee
        Route::post('/store/{id?}', 'store')->name('store');

        Route::get('/edit/{id}', 'edit')->name('edit');

        // delete thesisCommittee
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });

    // thesisDetail
    Route::resource('/thesisDetail', ThesisDetailController::class);
    // Route::prefix('/thesisDetail')->controller(ThesisDetailController::class)
    //     ->name('thesisDetail.')
    //     ->group(function () {
    //         // your code here
    //         // list thesisDetail and create or edit form

    //         Route::get('/', 'index')->name('index');

    //         // store or update thesisDetail
    //         Route::post('/store/{id?}', 'store')->name('store');

    //         Route::get('/edit/{id}', 'edit')->name('edit');

    //         // delete thesisDetail
    //         Route::delete('/delete/{id}', 'destroy')->name('destroy');
    //     });
=======
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
>>>>>>> main

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
