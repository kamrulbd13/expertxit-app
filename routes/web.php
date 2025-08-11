<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\TrainingController;
use App\Http\Controllers\VisitorController;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/contact',[HomeController::class, 'contact'])->name('contact.index');
Route::get('/ebook/store',[HomeController::class, 'ebook'])->name('ebook.store.index');
Route::get('/ebook/details/{id}', [HomeController::class, 'details'])->name('ebook.show.details');
Route::get('/training/details/{id}',[TrainingController::class, 'details'])->name('details');
Route::get('/job/guarantee/course/',[TrainingController::class, 'jobGuaranteeCourse'])->name('job.guarantee.course');


Route::get('/visitor-form', [VisitorController::class, 'create'])->name('visitor.form');
Route::post('/visitor-form', [VisitorController::class, 'store'])->name('visitor.store');
Route::get('/refresh-captcha', [VisitorController::class, 'refreshCaptcha']);


require __DIR__.'/WebCustomer.php';
require __DIR__.'/WebAdmin.php';
