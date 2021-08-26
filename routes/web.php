<?php

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

use App\Http\Livewire\Expense\{ExpenseCreate, ExpenseEdit, ExpenseList};
use App\Http\Livewire\Payment\CreditCard;
use App\Http\Livewire\Plan\{PlanCreate, PlanList};
use Illuminate\Support\Facades\{File, Storage};

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::prefix('expenses')->name('expenses.')->group(function(){
        Route::get('/', ExpenseList::class)->name('index');
        Route::get('/create', ExpenseCreate::class)->name('create');
        Route::get('/edit/{expense}', ExpenseEdit::class)->name('edit');

        Route::get('/{expense}/photo', function ($expense){
            $expense = auth()->user()->expenses->find($expense);

            if(!Storage::disk('public')->exists($expense->photo))
                return abort(404, 'Image not found!');

            $image = Storage::disk('public')->get($expense->photo);
            $mimetype = File::mimeType(storage_path('app/public/' . $expense->photo));

            return response($image)->header('Content-Type', $mimetype);
        })->name('photo');
    });

    Route::prefix('plans')->name('plans.')->group(function(){
        Route::get('/', PlanList::class)->name('index');
        Route::get('/create', PlanCreate::class)->name('create');
    });

});

Route::get('subscription', CreditCard::class)->name('plan.subscription');