<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\CustomPackageController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Public Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
  $teamMembers = \App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();
  $partners = \App\Models\Partner::where('is_active', true)->orderBy('order')->get();
  return view('about', compact('teamMembers', 'partners'));
})->name('about');

// Packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/custom', [CustomPackageController::class, 'create'])->name('packages.custom');
Route::post('/packages/custom', [CustomPackageController::class, 'store'])->name('packages.custom.store');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Flights (Public Leads)
Route::post('/flights/book', [FlightController::class, 'store'])->name('flights.book');
Route::get('/flights/success/{reference}', [FlightController::class, 'success'])->name('flights.success');
Route::get('/transfers', [FlightController::class, 'transfers'])->name('transfers.index');
Route::post('/transfers/book', [FlightController::class, 'storeTransfer'])->name('transfers.book');

// Visas (Public Info & Applications - Now Public)
Route::get('/visas', [VisaController::class, 'index'])->name('visas.index');
Route::get('/visas/{visa}', [VisaController::class, 'show'])->name('visas.show');
Route::post('/visas/apply', [VisaController::class, 'apply'])->name('visas.apply');

// Bookings (Now Public - No auth required)
Route::get('/book', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/book', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking-success/{id}', [BookingController::class, 'success'])->name('bookings.success');

// Additional Pages
use App\Http\Controllers\ContactController;

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Dashboard (User Profile)
Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $bookings = $user->bookings()->with('package')->latest()->get();
    $transferBookings = $user->transferBookings()->latest()->get();
    $flightBookings = $user->flightBookings()->latest()->get();
    $visaApplications = $user->visaApplications()->with('visa.destination')->latest()->get();

    return view('dashboard', compact('bookings', 'transferBookings', 'flightBookings', 'visaApplications'));
  })->name('dashboard');
});

Route::get('/mice', function () {
  return view('mice');
})->name('mice');

// Authentication Routes
require __DIR__ . '/auth.php';
