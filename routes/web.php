<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrganizationController;
use App\Http\Controllers\Admin\BookingAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\OrganizationServiceController;
use App\Http\Controllers\UserPagesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingWithLongWayController;
use App\Models\Service;
use App\Models\Review;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ReviewAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Organization_admin\OrgAdminController;

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





Route::get('/', [UserPagesController::class, 'showLanding'])->name('landing');
Route::get('/about', [UserPagesController::class, 'showAbout'])->name('about');
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/services', [OrganizationServiceController::class, 'showServices'])->name('services');
Route::get('/organizations', action: [OrganizationServiceController::class, 'showOrganizations'])->name('organizations');
Route::get('/providers/{name}', [OrganizationServiceController::class, 'getProviders'])->name('get.providers');
Route::get('/prov', action: [OrganizationServiceController::class, 'showprov'])->name('organizations');
Route::get('/reviews/{service}/{organization}', [ReviewController::class, 'show'])->name('reviews.show');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');




Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('organizations', OrganizationController::class);
    Route::resource('bookings', BookingAdminController::class);
    Route::get('admin-reviews', [ReviewAdminController::class, 'index'])->name('admin-reviews.index');
    Route::delete('admin/reviews/{review}', [ReviewAdminController::class, 'destroy'])->name('admin-reviews.destroy');
    Route::patch('/bookings/{id}/status/{status}', [BookingAdminController::class, 'updateStatus'])
        ->name('bookings.update-status');
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-profile', [AdminController::class, 'showprofile'])->name('admin.profile');
    Route::put('/admin/update-profile', [AdminController::class, 'updateAdminProfile'])->name('admin.updateProfile');
    Route::resource('contacts', ContactAdminController::class);

});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/book', function () {
        $services = Service::all();
        return view('user.bookingForm', compact('services'));
    })->name('booking.form');
    Route::get('/user-profile', [UserPagesController::class, 'userProfile'])->name('user.profile');
    Route::put('/user/profile', [UserPagesController::class, 'updateProfile'])->name('user.updateProfile');
    Route::patch('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
    Route::get('/get-organizations/{serviceId}', [BookingController::class, 'getOrganizations']);
    Route::get('/get-employees/{service}/{organization}', [BookingController::class, 'getEmployees']);
    Route::get('/get-booked-slots/{serviceId}/{organizationId}', [BookingController::class, 'getBookedSlots']);
    Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/get-price-and-available-employee/{serviceId}/{organizationId}', [BookingController::class, 'getPriceAndAvailableEmployee']);
    Route::get('/complete-booking/{serviceId}/{organizationId}', [BookingWithLongWayController::class, 'create'])->name('completeBooking');
    Route::post('/save-booking/{serviceId}/{organizationId}', [BookingWithLongWayController::class, 'store'])->name('saveBooking');
    Route::post('/reviews/{service}/{organization}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', action: [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', action: [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::middleware(['auth', 'role:organization_admin'])->group(function () {
    Route::get('/org-dashboard', [OrgAdminController::class, 'orgDashboard'])->name('org.dashboard');
    Route::get('/org-bookings', [OrgAdminController::class, 'bookings'])->name('org.bookings.index');
    Route::get('/org-reviews', [OrgAdminController::class, 'reviews'])->name('org.reviews.index');
    Route::get('/org-employees', [OrgAdminController::class, 'employees'])->name('org.employees.index');
    Route::get('/org-services', [OrgAdminController::class, 'services'])->name('org.services.index');
});
