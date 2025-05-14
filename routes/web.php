<?php

use App\Livewire\CartManager;
use App\Livewire\CheckoutForm;
use App\Livewire\CouponManager;
use App\Livewire\ProductManager;
use Illuminate\Support\Facades\Route;

Route::get('/', ProductManager::class);
Route::get('/carrinho', CartManager::class);
Route::get('/finalizar', CheckoutForm::class);
Route::get('/cupons', CouponManager::class);