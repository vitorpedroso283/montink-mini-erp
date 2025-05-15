<?php

use App\Livewire\CartManager;
use App\Livewire\CheckoutForm;
use App\Livewire\CouponManager;
use App\Livewire\ProductManager;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductManager::class)->name('products.index');;
Route::get('/cart', CartManager::class);
Route::get('/checkout', CheckoutForm::class)->name('checkout');
Route::get('/cupons', CouponManager::class);