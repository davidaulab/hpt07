<?php

use App\Http\Controllers\BeerController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',  [HomeController::class, 'index'])->name('home');

Route::post('/',  function () {
    $counter = session ('counter', 0);
    $counter++;
    session (['counter' => $counter]);
    return view ('home', compact ('counter'));

});
Route::get('/home', function () {
    return redirect()->route('home');
});


Route::get('/cervecerias', [BreweryController::class, 'index'])->name('breweries');
Route::get('/cervecerias/mispropuestas', [BreweryController::class, 'proposals'])->name('breweries.proposals');


Route::group(['middleware' => 'auth'], function () {
    Route::get ('/cervecerias/create', [BreweryController::class, 'create'])->name('breweries.create');
    Route::post ('/cervecerias/store', [BreweryController::class, 'store'])->name('breweries.store');
    
    Route::get ('/cervecerias/edit/{brewery}', [BreweryController::class, 'edit'])->name('breweries.edit');
    Route::put ('/cervecerias/update/{brewery}', [BreweryController::class, 'update'])->name('breweries.update');
    
    Route::delete ('/cervecerias/delete/{brewery}', [BreweryController::class, 'delete'])->name('breweries.delete');
});




Route::get ('/cervecerias/{brewery}', [BreweryController::class, 'show'])->name('breweries.show');



Route::resource('/beers', BeerController::class)->parameters(["beers"]);

Route::get('/cerveza/{name}', [BeerController::class, 'friendly']);


Route::get ('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get ('/about', function () { 
    return view ('about');
})->name('about');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
