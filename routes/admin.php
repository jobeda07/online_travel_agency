<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Common\CityAction;
use App\Http\Controllers\Common\HomeAction;
use App\Http\Controllers\Common\UserAction;
use App\Http\Controllers\Common\AdminAction;
use App\Http\Controllers\Common\CountryAction;
use App\Http\Controllers\Common\SettingAction;
use App\Http\Controllers\Common\CurrencyAction;
use App\Http\Controllers\Common\CustomerAction;
use App\Http\Controllers\Common\LanguageAction;
use App\Http\Controllers\Common\AccountAction;
use App\Http\Controllers\Common\OurPartnerAction;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Common\PaymentMethodAction;
use App\Http\Controllers\Common\AdminDashboardAction;
use App\Http\Controllers\Common\RolePermissionAction;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Common\AdminSupportTicketAction;
use App\Http\Controllers\Common\HolidayPackageAction;
use App\Http\Controllers\Common\SliderAction;
use App\Http\Controllers\Common\DynamicTranslateAction;
use App\Http\Controllers\Hotel\BookingAction as HotelBookingAction;
use App\Http\Controllers\AirTicket\BookingAction as AirTicketBookingAction;

//admin auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
});
Route::get('/getcities/{id}', [AdminDashboardAction::class, 'getcities'])->name('getcities');
//Admin Routes
Route::prefix('admin')->group(static function () {
    Route::middleware('admin')->group(function () {

        Route::get('/dashboard', [AdminDashboardAction::class, 'index'])->name('admin.dashboard');
        Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        //store translate data
        Route::post('/store-translate-data', [DynamicTranslateAction::class, 'store'])->name('store.translateData');
        //customer
        Route::prefix('customer')->name('customer.')->group(static function () {
            Route::get('/list', [CustomerAction::class, 'index'])->name('list');
            Route::get('/create', [CustomerAction::class, 'create'])->name('create');
            Route::post('/store', [CustomerAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [CustomerAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [CustomerAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CustomerAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CustomerAction::class, 'destroy'])->name('destroy');
        });
        //airticket booking
        Route::prefix('airticket/booking')->name('airticket.booking.')->group(static function () {
            Route::get('/list', [AirTicketBookingAction::class, 'index'])->name('list');
            Route::get('/create', [AirTicketBookingAction::class, 'create'])->name('create');
            Route::post('/store', [AirTicketBookingAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [AirTicketBookingAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [AirTicketBookingAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AirTicketBookingAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [AirTicketBookingAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [AirTicketBookingAction::class, 'status'])->name('status');
            Route::get('/show/{id}', [AirTicketBookingAction::class, 'show'])->name('show');
            Route::get('/pdf/download/{id}', [AirTicketBookingAction::class, 'pdf_download'])->name('pdf.download');
            Route::get('/reports', [AirTicketBookingAction::class, 'reports'])->name('reports');
        });
        //hotel booking
        Route::prefix('hotel/booking')->name('hotel.booking.')->group(static function () {
            Route::get('/list', [HotelBookingAction::class, 'index'])->name('list');
            Route::get('/create', [HotelBookingAction::class, 'create'])->name('create');
            Route::post('/store', [HotelBookingAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [HotelBookingAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [HotelBookingAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [HotelBookingAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [HotelBookingAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [HotelBookingAction::class, 'status'])->name('status');
            Route::get('/show/{id}', [HotelBookingAction::class, 'show'])->name('show');
            Route::get('/pdf/download/{id}', [HotelBookingAction::class, 'pdf_download'])->name('pdf.download');
            Route::get('/reports', [HotelBookingAction::class, 'reports'])->name('reports');
        });
        //country_route
        Route::prefix('country')->name('country.')->group(static function () {
            Route::get('/list', [CountryAction::class, 'index'])->name('list');
            Route::get('/create', [CountryAction::class, 'create'])->name('create');
            Route::post('/store', [CountryAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [CountryAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [CountryAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CountryAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CountryAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [CountryAction::class, 'status'])->name('status');
        });
        //city_route
        Route::prefix('city')->name('city.')->group(static function () {
            Route::get('/list', [CityAction::class, 'index'])->name('list');
            Route::get('/create', [CityAction::class, 'create'])->name('create');
            Route::post('/store', [CityAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [CityAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [CityAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CityAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CityAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [CityAction::class, 'status'])->name('status');
        });
        //currency_route
        Route::prefix('currency')->name('currency.')->group(static function () {
            Route::get('/list', [CurrencyAction::class, 'index'])->name('list');
            Route::get('/create', [CurrencyAction::class, 'create'])->name('create');
            Route::post('/store', [CurrencyAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [CurrencyAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [CurrencyAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CurrencyAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CurrencyAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [CurrencyAction::class, 'status'])->name('status');
        });
        //paymentMethod_route
        Route::prefix('paymentMethod')->name('paymentMethod.')->group(static function () {
            Route::get('/list', [PaymentMethodAction::class, 'index'])->name('list');
            Route::get('/create', [PaymentMethodAction::class, 'create'])->name('create');
            Route::post('/store', [PaymentMethodAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [PaymentMethodAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [PaymentMethodAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PaymentMethodAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PaymentMethodAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [PaymentMethodAction::class, 'status'])->name('status');
        });
        //support ticket
        Route::prefix('adminSupportTicket')->name('adminSupportTicket.')->group(static function () {
            Route::get('/list', [AdminSupportTicketAction::class, 'index'])->name('list');
            Route::get('/edit/{id}', [AdminSupportTicketAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AdminSupportTicketAction::class, 'update'])->name('update');
            Route::get('/show/{id}', [AdminSupportTicketAction::class, 'show'])->name('show');
            Route::delete('/destroy/{id}', [AdminSupportTicketAction::class, 'destroy'])->name('destroy');
            Route::get('/create/new/message/{id}', [AdminSupportTicketAction::class, 'createNewMessage'])->name('create.newMessage');
            Route::post('/store/new/message/{id}', [AdminSupportTicketAction::class, 'storeNewMessage'])->name('store.newMessage');
        });
        //Role
        Route::prefix('Role')->name('role.')->group(static function () {
            Route::get('/list', [RolePermissionAction::class, 'index'])->name('list');
            Route::get('/create', [RolePermissionAction::class, 'create'])->name('create');
            Route::post('/store', [RolePermissionAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [RolePermissionAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [RolePermissionAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [RolePermissionAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [RolePermissionAction::class, 'destroy'])->name('destroy');
            // Route::get('/status/{id}', [RolePermissionAction::class, 'status'])->name('status');
            Route::get('/show-permission/{id}', [RolePermissionAction::class, 'show_permission'])->name('show.permission');
            Route::post('/give-permission/{id}', [RolePermissionAction::class, 'give_permission'])->name('give.permission');
        });
        //user
        Route::prefix('user')->name('user.')->group(static function () {
            Route::get('/list', [AdminAction::class, 'index'])->name('list');
            Route::get('/create', [AdminAction::class, 'create'])->name('create');
            Route::post('/store', [AdminAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [AdminAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [AdminAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [AdminAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [AdminAction::class, 'destroy'])->name('destroy');
        });
        //language
        Route::prefix('language')->name('language.')->group(static function () {
            Route::get('/list', [LanguageAction::class, 'index'])->name('list');
            Route::get('/create', [LanguageAction::class, 'create'])->name('create');
            Route::post('/store', [LanguageAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [LanguageAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [LanguageAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [LanguageAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [LanguageAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [LanguageAction::class, 'status'])->name('status');
            Route::get('/translation/{id}', [LanguageAction::class, 'translation'])->name('translation');
            Route::post('/translation/store/{id}', [LanguageAction::class, 'translation_store'])->name('translation.store');
        });
        //setting
        Route::prefix('setting')->name('setting.')->group(static function () {
            Route::get('/', [SettingAction::class, 'index'])->name('list');
            Route::get('/create', [SettingAction::class, 'create'])->name('create');
            Route::post('/store', [SettingAction::class, 'store'])->name('store');
            Route::get('/show/{id}', [SettingAction::class, 'show'])->name('show');
            Route::get('/edit/{id}', [SettingAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SettingAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SettingAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [SettingAction::class, 'status'])->name('status');
            Route::get('/translation/{id}', [SettingAction::class, 'translation'])->name('translation');
            Route::post('/translation/store/{id}', [SettingAction::class, 'translation_store'])->name('translation.store');
        });
        //account
        Route::prefix('account')->name('account.')->group(static function () {
            Route::get('/head', [AccountAction::class, 'index'])->name('head.list');
            Route::post('/store', [AccountAction::class, 'store'])->name('head.store');
            Route::put('/update/{id}', [AccountAction::class, 'update'])->name('head.update');
            Route::delete('/destroy/{id}', [AccountAction::class, 'destroy'])->name('head.destroy');
            Route::get('/status/{id}', [AccountAction::class, 'status'])->name('head.status');
            Route::get('/ledgers', [AccountAction::class, 'ledgerIndex'])->name('ledger.list');
            Route::get('/ledger/create', [AccountAction::class, 'ledgerCreate'])->name('ledger.create');
            Route::post('/ledger/store', [AccountAction::class, 'ledgerStore'])->name('ledger.store');
            Route::get('/ledger/edit/{id}', [AccountAction::class, 'ledgerEdit'])->name('ledger.edit');
            Route::put('/ledger/update/{id}', [AccountAction::class, 'ledgerUpdate'])->name('ledger.update');
            Route::delete('/ledger/delete/{id}', [AccountAction::class, 'ledgerDelete'])->name('ledger.destroy');
        });
        //our partner
        Route::prefix('our-partner')->name('ourPartner.')->group(static function () {
            Route::get('/', [OurPartnerAction::class, 'index'])->name('list');
            Route::post('/store', [OurPartnerAction::class, 'store'])->name('store');
            Route::put('/update/{id}', [OurPartnerAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [OurPartnerAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [OurPartnerAction::class, 'status'])->name('status');
        }); 
        //holiday Package
        Route::prefix('holiday-package')->name('holiday.package.')->group(static function () {
            Route::get('/', [HolidayPackageAction::class, 'index'])->name('list');
            Route::get('/create', [HolidayPackageAction::class, 'create'])->name('create');
            Route::post('/store', [HolidayPackageAction::class, 'store'])->name('store');
            Route::get('/edit/{id}', [HolidayPackageAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [HolidayPackageAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [HolidayPackageAction::class, 'destroy'])->name('destroy');
            Route::get('/show/{id}', [HolidayPackageAction::class, 'show'])->name('show');
            Route::get('/status/{id}', [HolidayPackageAction::class, 'status'])->name('status');
        });
        // sliders
        Route::prefix('slider')->name('slider.')->group(static function () {
            Route::get('/', [SliderAction::class, 'index'])->name('list');
            Route::get('/create', [SliderAction::class, 'create'])->name('create');
            Route::post('/store', [SliderAction::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SliderAction::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [SliderAction::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [SliderAction::class, 'destroy'])->name('destroy');
            Route::get('/status/{id}', [SliderAction::class, 'status'])->name('status');
        });
    });
});
