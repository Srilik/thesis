<?php

use App\Http\Controllers\Thesis\ThesisController;
use App\Http\Controllers\Thesis\ThesisManagement\ManagementController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Thesis\ThesisManagement\ThesisCommitteessController;
use App\Http\Controllers\Thesis\ThesisManagement\ThesisssController;
use App\Http\Controllers\Thesis\ThesisManagement\ThesisStudentssController;

Route::prefix('/thesis')
    ->middleware(['auth:staff', 'wildcard_permission'])
    ->name('thesis.')
    ->group(function () {
        // name:thesis.index
        Route::get('/', [ThesisController::class, 'index'])->name('index');


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
