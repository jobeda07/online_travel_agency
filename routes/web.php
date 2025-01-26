<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\HomeAction;
use App\Http\Controllers\Common\Frontend\Ticket\SupportTicketAction;
//use App\Http\Controllers\Common\Frontend\Ticket\SupportTicketAction;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/set-language/{lang_code}', [HomeAction::class, 'setLanguage'])->name('setLanguage');
Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeAction::class, 'index'])->name('home');

    //supportTicket_route
    Route::prefix('support-ticket')->name('supportTicket.')->group(static function () {
        Route::get('/list', [SupportTicketAction::class, 'index'])->name('list');
        Route::get('/create', [SupportTicketAction::class, 'create'])->name('create');
        Route::post('/store', [SupportTicketAction::class, 'store'])->name('store');
        Route::get('/show/{id}', [SupportTicketAction::class, 'show'])->name('show');
        Route::delete('/destroy/{id}', [SupportTicketAction::class, 'destroy'])->name('destroy');
        Route::get('/create/new/message/{id}', [SupportTicketAction::class, 'createNewMessage'])->name('create.newMessage');
        Route::post('/store/new/message/{id}', [SupportTicketAction::class, 'storeNewMessage'])->name('store.newMessage');
    });
});


require __DIR__ . '/admin.php';
