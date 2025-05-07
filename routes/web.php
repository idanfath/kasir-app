<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionDetailController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "auth"], function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::resource("item", ItemController::class)->except(["show"]);
    Route::resource("transaction", TransactionController::class);
    Route::delete("rollback/{transaction}", [TransactionController::class, "rollback"])->name("transaction.rollback");
    Route::middleware(CheckRole::class . ":admin")->group(function () {
        Route::resource("officer", OfficerController::class)->except(["show"]);
    });
});

Route::get("/login", [AuthController::class, "loginform"])->name("login");
Route::post("/login", [AuthController::class, "login"])->name("login.post");
Route::post("/logout", [AuthController::class, "logout"])->name("logout");
