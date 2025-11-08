<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    $query = request()->query('q', ''); // q parametri, default bo'sh

    // Typesense orqali qidiruv
    $products = Product::search($query)->paginate(10);

    // Relation ma'lumotini olish uchun kerak bo'lsa, eager load qilamiz
    $products->getCollection()->load('attribute');

    return $products;
});
