<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StripeContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', fn () => auth()->check() ? redirect('/home') : view('welcome'));

Auth::routes();

Route::get('/checkout', [StripeContoller::class, 'checkout'])->name('checkout');

Route::get('/billing-portal', [StripeContoller::class, 'billingPortal'])->name('billing-portal');

Route::get('/free-trial-end', [StripeContoller::class, 'freeTrialEnd'])->name('free-trial-end');


Route::middleware(['auth', 'subscription'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('contacts', ContactController::class);
});
// Route::get('contact', fn () => Response::view('contact'));

// Route::post('/contact', function (Request $request) {
//     $data = $request->all();
//     // $contact = new Contact();
//     // $contact->name = $data["name"];
//     // $contact->phone_number = $data["phone_number"];
//     // $contact->save();

//     Contact::create($data);
//     return "Contact stored"; 
// });

// Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
// Route::get('/contacts/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
// Route::put('/contacts/{contact}/', [ContactController::class, 'update'])->name('contacts.update');
// Route::get('/contacts/{contact}/', [ContactController::class, 'show'])->name('contacts.show');
// Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
// Route::delete('/contacts/{contact}/', [ContactController::class, 'destroy'])->name('contacts.destroy');
// Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
