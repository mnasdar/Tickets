<?php

use App\Livewire\GenerateTickets;
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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/event', function () {
        return view('event');
    })->name('event');


    Route::group(['prefix' => '/ticket'], function () {
        Route::get('/', function () {
            return view('ticket');
        })->name('ticket');
        
        Route::get('/generate-ticket/{ticket_id}', function ($ticket_id) {
            return view('generate-ticket', compact('ticket_id'));
        })->name('generate-ticket');
    });

    Route::group(['prefix' => '/scan'], function () {
        Route::get('/', function () {
            return view('scan');
        })->name('scan');

        Route::get('/scan-ticket/{event_id}', function ($event_id) {
            return view('scan-ticket', compact('event_id'));
        })->name('scan-ticket');
    });
});
