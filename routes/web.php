<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Models\Admin\Apartment;
use App\Models\Admin\Subscription;
use App\Models\Admin\Lead;
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
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('/dashboard/admin', ApartmentController::class)->parameters([
        'admin' => 'apartment:slug',
    ]);

    // subscription
    Route::post('/subscription', [SubscriptionController::class, 'token'])->name('subscription');
    Route::get('/subscription', [SubscriptionController::class, 'index'])->name('admin.subscription');
    Route::delete('/subscription', [SubscriptionController::class, 'destroy'])->name('admin.subscription.destroy');
    
    // dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $apartments = Apartment::where('user_id', $user->id)->get();
    
        // Ora possiamo ottenere le sottoscrizioni associate a ciascun appartamento con i dati della pivot
        foreach ($apartments as $apartment) {
            $apartment->subscriptions = $apartment->subscriptions()->get();
            $apartment->leads = Lead::where('apartment_id', $apartment->id)->get();
        }
        return view('admin.dashboard', compact('user','apartments'));
    })->name('dashboard');
});

require __DIR__.'/auth.php';