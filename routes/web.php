<?php

use App\Http\Controllers\KarzinkaController;
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

Route::get('/', function () {
    return view('users.login');
})->name('login');


Route::get('/usersCreate', function () {
    return view('users.usersCreate');
})->name('usersCreate');

Route::get('/categoryCreate', function () {
    return view('category.categoryCreate');
})->name('categoryCreate');



    Route::post('/usersLogin',[KarzinkaController::class,'usersLogin'])->name('usersLogin');

    Route::get('/usersPage',[KarzinkaController::class,'usersPage'])->name('usersPage');

    Route::get('/usersDelete/{id}',[KarzinkaController::class,'usersDelete'])->name('usersDelete');

    Route::get('/usersUpdate/{id}',[KarzinkaController::class,'usersUpdateb'])->name('usersUpdate');

    Route::post('/usersUpdate/{id}',[KarzinkaController::class,'usersUpdate'])->name('usersUpdate');

    Route::post('/usersCreate',[KarzinkaController::class,'usersCreate'])->name('usersCreate');




    Route::get('/categoryPage',[KarzinkaController::class,'categoryPage'])->name('categoryPage');

    Route::get('/categoryDelete/{id}',[KarzinkaController::class,'categoryDelete'])->name('categoryDelete');

    Route::post('/categoryCreate',[KarzinkaController::class,'categoryCreate'])->name('ctegoryCreate');

    Route::get('/categoryUpdate/{id}',[KarzinkaController::class,'categoryUpdateb'])->name('categoryUpdate');

    Route::post('/categoryUpdate/{id}',[KarzinkaController::class,'categoryUpdate'])->name('categoryUpdate');
 
    Route::get('/categoryProduct/{id}',[KarzinkaController::class,'categoryProduct'])->name('categoryProduct');





    Route::get('/productCreate/{id}',[KarzinkaController::class,'productCreateb'])->name('productCreate');

    Route::post('/productCreate/{id}',[KarzinkaController::class,'productCreate'])->name('productCreate');

    Route::get('/productDelete/{id}',[KarzinkaController::class,'productDelete'])->name('productDelete');

    Route::post('/productUpdate/{id}',[KarzinkaController::class,'productUpdate'])->name('productUpdate');

    Route::get('/productUpdate/{id}',[KarzinkaController::class,'productUpdateb'])->name('productUpdate');
    
    Route::get('/productCreateAll',[KarzinkaController::class,'productCreateAllb'])->name('productCreateAll');
    
    Route::post('/productCreateAll',[KarzinkaController::class,'productCreateAll'])->name('productCreateAll');
    
    Route::post('/productUpdateAll/{id}',[KarzinkaController::class,'productUpdateAll'])->name('productUpdateAll');

    Route::get('/productUpdateAll/{id}',[KarzinkaController::class,'productUpdateAllb'])->name('productUpdateAll');





    Route::get('/productBasket/{id}',[KarzinkaController::class,'productBasket'])->name('productBasket');

    Route::get('/productAbort/{id}',[KarzinkaController::class,'productAbort'])->name('productAbort');

    Route::get('/productSold',[KarzinkaController::class,'productsold'])->name('productSold');

    Route::get('/allProductBasket/{id}',[KarzinkaController::class,'allProductBasket'])->name('allProductBasket');

    Route::get('/allProductAbort/{id}',[KarzinkaController::class,'allProductAbort'])->name('allProductAbort');






    Route::get('/logout',[KarzinkaController::class,'logout'])->name('logout');

    Route::get('/achot',[KarzinkaController::class,'achot'])->name('achot');

    Route::get('/allProducts',[KarzinkaController::class,'allProducts'])->name('allProducts');

  