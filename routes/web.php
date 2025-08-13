<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\DesignerAuthController;
use App\Http\Controllers\Auth\BuyerAuthController;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\DesignerDashboardController;
use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\CartController;

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

Route::get('/', [MarketplaceController::class, 'welcome'])->name('welcome');

// Public Marketplace Routes (no authentication required)
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/designs/{design}', [MarketplaceController::class, 'show'])->name('marketplace.design.show');

// Public Cart Routes (no authentication required)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/data', [CartController::class, 'getCartData'])->name('cart.data');

// Cart Checkout Routes (buyer authentication required)
Route::middleware('auth:buyer')->group(function () {
    Route::post('/cart/checkout', [CartController::class, 'processCheckout'])->name('cart.checkout');
    Route::get('/cart/payment', [CartController::class, 'showCartPayment'])->name('buyer.payment.cart');
    Route::post('/cart/payment/process', [CartController::class, 'processCartPayment'])->name('buyer.payment.cart-process');
    Route::get('/cart/payment/success', [CartController::class, 'showCartPaymentSuccess'])->name('buyer.payment.cart-success');
});

// Generic login route fallback - redirect to buyer login
Route::get('/login', function () {
    return redirect()->route('buyer.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Designer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('designer')->group(function () {
    // Registration Routes
    Route::get('register', [DesignerAuthController::class, 'showRegistrationForm'])->name('designer.register');
    Route::post('register', [DesignerAuthController::class, 'register']);

    // Login Routes
    Route::get('login', [DesignerAuthController::class, 'showLoginForm'])->name('designer.login');
    Route::post('login', [DesignerAuthController::class, 'login']);

    // Logout Route
    Route::post('logout', [DesignerAuthController::class, 'logout'])->name('designer.logout');

    // Dashboard Route (protected)
    Route::get('dashboard', [DesignerDashboardController::class, 'index'])
        ->middleware('auth:designer')
        ->name('designer.dashboard');

    // Protected Designer Routes
    Route::middleware('auth:designer')->group(function () {
        // Orders Management
        Route::get('orders', [DesignerDashboardController::class, 'orders'])->name('designer.orders');
        Route::patch('orders/{order}/status', [DesignerDashboardController::class, 'updateOrderStatus'])->name('designer.orders.update-status');
        
        // Profile Management
        Route::get('profile', [DesignerDashboardController::class, 'showProfile'])->name('designer.profile');
        Route::put('profile', [DesignerDashboardController::class, 'updateProfile'])->name('designer.profile.update');

        // Design Management Routes
        Route::resource('designs', DesignController::class)->names([
            'index' => 'designer.designs.index',
            'create' => 'designer.designs.create',
            'store' => 'designer.designs.store',
            'show' => 'designer.designs.show',
            'edit' => 'designer.designs.edit',
            'update' => 'designer.designs.update',
            'destroy' => 'designer.designs.destroy',
        ]);
        
        // Additional design routes
        Route::patch('designs/{design}/toggle-status', [DesignController::class, 'toggleStatus'])
            ->name('designer.designs.toggle-status');
    });
});

/*
|--------------------------------------------------------------------------
| Buyer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::prefix('buyer')->group(function () {
    // Registration Routes
    Route::get('register', [BuyerAuthController::class, 'showRegistrationForm'])->name('buyer.register');
    Route::post('register', [BuyerAuthController::class, 'register']);

    // Login Routes
    Route::get('login', [BuyerAuthController::class, 'showLoginForm'])->name('buyer.login');
    Route::post('login', [BuyerAuthController::class, 'login']);

    // Logout Route
    Route::post('logout', [BuyerAuthController::class, 'logout'])->name('buyer.logout');

    // Dashboard Route (protected)
    Route::get('dashboard', [BuyerDashboardController::class, 'index'])
        ->middleware('auth:buyer')
        ->name('buyer.dashboard');

    // Marketplace Routes (protected)
    Route::middleware('auth:buyer')->group(function () {
        // Marketplace - Browse all designs
        Route::get('marketplace', [BuyerDashboardController::class, 'marketplace'])
            ->name('buyer.marketplace');
        
        // Design detail view
        Route::get('designs/{design}', [BuyerDashboardController::class, 'showDesign'])
            ->name('buyer.designs.show');
        
        // Order Management Routes
        Route::get('orders', [BuyerDashboardController::class, 'orderHistory'])
            ->name('buyer.orders.index');
        
        Route::get('orders/{order}', [BuyerDashboardController::class, 'showOrder'])
            ->name('buyer.orders.show');
        
        // Order Creation Routes
        Route::get('designs/{design}/order', [OrderController::class, 'create'])
            ->name('buyer.orders.create');
        
        Route::post('orders', [OrderController::class, 'store'])
            ->name('buyer.orders.store');
        
        // Quick buy (one-click purchase)
        Route::post('designs/{design}/quick-buy', [OrderController::class, 'quickBuy'])
            ->name('buyer.orders.quick-buy');
        
        // Order actions
        Route::patch('orders/{order}/cancel', [OrderController::class, 'cancel'])
            ->name('buyer.orders.cancel');
        
        // Order statistics API
        Route::get('api/orders/stats', [OrderController::class, 'getStats'])
            ->name('buyer.orders.stats');
        
        // Payment Routes
        Route::get('payment/{order}', [PaymentController::class, 'show'])
            ->name('buyer.payment.show');
        
        Route::post('payment/{order}/process', [PaymentController::class, 'process'])
            ->name('buyer.payment.process');
        
        Route::get('payment/{order}/success', [PaymentController::class, 'success'])
            ->name('buyer.payment.success');
    });
});
