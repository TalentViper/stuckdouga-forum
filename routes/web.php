<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\AccountController;
// use App\Http\Controllers\Site\BookingOrderController;
// use App\Http\Controllers\Site\RubbishOrderController;
// use App\Http\Controllers\Site\GoogleController;
use App\Http\Controllers\Site\PasswordController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RegisterController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookingController;
// use App\Http\Controllers\Admin\JobController;
// use App\Http\Controllers\Admin\RubbishController;
// use App\Http\Controllers\Admin\TeamController;
// use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\SupportController;
// use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ServiceController;
// use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ForumController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\MarketController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ArtWorkController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ArtWorkItemController;
// use App\Http\Controllers\StripeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/google-autocomplete/{data}', [GoogleController::class, 'index'])->name('googlemaps');
// Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/uploadItems', [AccountController::class, 'uploadItems'])->name('uploadItems');

Route::get('/', [HomeController::class, 'comingsoon'])->name('comingsoon');
Route::prefix('beta')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');


    Route::get('login', [LoginController::class, 'loginView'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('user.login');
    Route::get('register', [RegisterController::class, 'registerView'])->name('register');
    Route::post('register', [RegisterController::class, 'register'])->name('user.register');
    Route::get('/created', [RegisterController::class, 'created'])->name('user.created');
    
    Route::get('/forgot-password', [PasswordController::class, 'forgotPasswordRequest'])->name('password.request');
    Route::post('/forgot-password', [PasswordController::class, 'forgotPassword'])->name('password.email');
    Route::get('/reset-password/{token}', [PasswordController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [PasswordController::class, 'updatePassword'])->name('password.update');
    Route::get('/coming', [HomeController::class, 'coming'])->name('coming');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/beta');
    })->middleware(['auth', 'signed'])->name('verification.verify');


    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('/account', [HomeController::class, 'account'])->name('account');
        Route::prefix('account')->group(function () {
            Route::get('/detail', [AccountController::class, 'detail'])->name('detail');
            Route::get('/gallery', [AccountController::class, 'gallery'])->name('accountgallery');
            Route::get('/link', [AccountController::class, 'link'])->name('link');
            Route::get('/message', [AccountController::class, 'message'])->name('accountmessage');
            Route::get('/news', [AccountController::class, 'news'])->name('news');
            Route::get('/private', [AccountController::class, 'private'])->name('private');
            Route::get('/profile', [AccountController::class, 'profile'])->name('profile');
            Route::get('/upload/{galleryId}', [AccountController::class, 'upload'])->name('artworkupload');
            Route::get('/wishlist', [AccountController::class, 'wishlist'])->name('wishlist');  
        });
        
        Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
        Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
        Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
        Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
        Route::post('/threads/{thread}/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/threads/{thread}/like', [ThreadController::class, 'like'])->name('threads.like');
        Route::post('/threads/{thread}/unlike', [ThreadController::class, 'unlike'])->name('threads.unlike');
        Route::post('/comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');
        Route::post('/comments/{comment}/unlike', [CommentController::class, 'unlike'])->name('comments.unlike');
        Route::resource('artworks', ArtWorkController::class);
        Route::resource('artworkitems', ArtWorkItemController::class);
        Route::resource('galleries', GalleryController::class);
        Route::resource('users', UserController::class);
        Route::resource('newsupdates', NewsController::class);
        Route::resource('links', LinkController::class);
        Route::resource('wishlists', WishListController::class);
        Route::resource('messages', MessageController::class);
        Route::post('updateDetail', [UserController::class, 'updateDetail'])->name('user.updatedetail');
        Route::post('updatePassword', [UserController::class, 'updatePassword'])->name('user.updatePassword');
        Route::post('updateNewsPassword', [NewsController::class, 'updateNewsPassword'])->name('user.updateNewsPassword');
        Route::post('updatePrivatePassword', [UserController::class, 'updatePrivatePassword'])->name('user.updatePrivatePassword');
        Route::post('updatePrivateContent', [UserController::class, 'updatePrivateContent'])->name('user.updatePrivateContent');
        Route::post('deleteMessages', [MessageController::class, 'deleteMessages'])->name('deleteMessages');
        Route::post('/gallery/{id}/like', [GalleryController::class, 'like'])->name('gallery.like');
        Route::post('/artwork/{id}/like', [ArtWorkController::class, 'like'])->name('artwork.like');
        Route::post('/messages/send', [MessageController::class, 'sendMessage'])->name('messages.send');
        Route::get('/messages/receive', [MessageController::class, 'receiveMessages']);
        Route::get('/account/openMessageForm', [MessageController::class, 'openMessageForm'])->name('openMessageForm');
        Route::post('/follow/{user}', [FollowController::class, 'follow']);
        Route::post('/unfollow/{user}', [FollowController::class, 'unfollow']);
    });

    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('/resource', [HomeController::class, 'resource'])->name('resource');
    Route::get('/member/{id}', [HomeController::class, 'member'])->name('member');
    Route::get('/artwork/{id}', [HomeController::class, 'artwork'])->name('artwork');
    Route::get('/tags', [HomeController::class, 'tags'])->name('tags');
    Route::get('/gallery/{id}', [GalleryController::class, 'gallery'])->name('gallery');
    Route::get('/latest/{keyword?}', [GalleryController::class, 'search'])->name('latest');
    Route::get('/popular/{keyword?}', [GalleryController::class, 'search'])->name('popular');
    Route::get('/update/{keyword?}', [GalleryController::class, 'search'])->name('update');
    Route::get('/populartag/{keyword?}', [GalleryController::class, 'search'])->name('populartag');
});


// admin route
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'adminLoginView'])->name('login.form');
    Route::post('login', [LoginController::class, 'adminLogin'])->name('login');

    Route::group(['middleware' => ['auth:admin']], function () {
        //dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //gallery
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery');

        //message
        Route::get('message', [MessageController::class, 'index'])->name('message');

        //message
        Route::get('market', [MarketController::class, 'index'])->name('market');

        //tag
        Route::get('tag', [TagController::class, 'index'])->name('tag');
        //tag
        Route::resource('content', ContentController::class);

        //customers
        Route::get('customers', [UserController::class, 'customers'])->name('customers');
        Route::post('customers', [UserController::class, 'createNewCustomer'])->name('customers.create');
        Route::get('/customers/{id}', [UserController::class, 'showCustomer'])->name('customers.show');
        Route::delete('/customers/{id}', [UserController::class, 'removeCustomer'])->name('customers.remove');
        Route::post('edit-customer', [UserController::class, 'editCustomer'])->name('customers.update');
        Route::get('search-customer', [UserController::class, 'searchCustomer'])->name('customers.search');
        Route::get('validate-customer', [UserController::class, 'validateCustomer'])->name('customers.validate');
        Route::post('customers-ajax', [UserController::class, 'createCustomerViaAjax'])->name('customers.create.ajax');


        //services
        Route::get('services', [ServiceController::class, 'index'])->name('services');

        //website
        Route::get('website', [WebsiteController::class, 'index'])->name('website');
        Route::get('/website/{id}', [WebsiteController::class, 'show'])->name('website.show');
        Route::post('edit-page', [WebsiteController::class, 'update'])->name('website.update');
        Route::post('/upload-image', [WebsiteController::class, 'uploadImage'])->name('upload');



        //settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        //logout
        Route::post('logout', [LoginController::class, 'adminLogout'])->name('logout');

        //threads
        // Route::get('/threads', [ThreadController::class, 'index'])->name('threads.index');
        // Route::get('/threads/create', [ThreadController::class, 'create'])->name('threads.create');
        // Route::get('/threads/{thread}', [ThreadController::class, 'show'])->name('threads.show');
        // Route::post('/threads', [ThreadController::class, 'store'])->name('threads.store');
        // Route::post('/threads/{thread}/comments', [CommentController::class, 'store'])->name('comments.store');
        
        Route::resource('threads', ThreadController::class);
        Route::resource('artworks', ArtWorkController::class);
        Route::resource('galleries', GalleryController::class);
        
    });
});


