<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

Route::get('/seed-post', function () {
    $categoryId = \Illuminate\Support\Facades\DB::table('categories')->insertGetId([
        'name' => 'Sample Category',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    \App\Models\Post::create([
        'title' => 'Sample Post',
        'text' => 'This is a sample content.',
        'category_id' => $categoryId,
    ]);

    return 'OK';
});
