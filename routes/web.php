<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\SearchController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
  $user=auth()->user();
  $jobs=Job::all();
  return view('home',compact('jobs','user'));
})->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('job')->group(function(){
  Route::get('jobs',[JobController::class,'index']);
  Route::get('create',[JobController::class,'create']);
  Route::post('store',[JobController::class,'store'])->name('job.store');
  Route::patch('edit/{id}',[JobController::class,'edit']);
  Route::delete('delete/{id}',[JobController::class,'destroy']);
});

Route::prefix('search')->group(function(){
  Route::get('job',[SearchController::class,'searchJob'])->name('search.job');
  Route::get('talent',[SearchController::class,'searchTalent'])->name('search.talent');
  Route::post('tag',[SearchController::class,'searchTag'])->name('search.tag');
  Route::patch('skill',[SearchController::class,'searchSkill'])->name('search.skill');
  Route::delete('freelancer',[SearchController::class,'searchFreelancer'])->name('search.freelancer');
});

Route::prefix('proposal')->group(function(){
    Route::get('proposals',[ProposalController::class,'index']);
    Route::get('create',[ProposalController::class,'create']);
    Route::post('store',[ProposalController::class,'store']);
    Route::patch('edit/{id}',[ProposalController::class,'edit']);
    Route::delete('delete/{id}',[ProposalController::class,'destroy']);
});

Route::prefix('user')->group(function(){
  Route::get('notifications',[UserController::class,'notifications']);
  Route::post('notification/mark-as-read',[UserController::class,'markAsReas']);
});

Route::prefix('client')->group(function(){
  Route::post('hire',[]);
});

Route::prefix('portofolio')->group(function(){
    Route::get('all',[PortofolioController::class,'index']);
    Route::get('create',[PortofolioController::class,'create']);
    Route::post('store',[PortofolioController::class,'store']);
    Route::patch('edit/{id}',[PortofolioController::class,'edit']);
    Route::delete('delete/{id}',[PortofolioController::class,'destroy']);
});

Route::prefix('employment')->group(function(){
    Route::get('all',[EmploymentController::class,'index']);
    Route::get('create',[EmploymentController::class,'create']);
    Route::post('store',[EmploymentController::class,'store']);
    Route::patch('edit/{id}',[EmploymentController::class,'edit']);
    Route::delete('delete/{id}',[EmploymentController::class,'destroy']);
});

Route::prefix('search')->group(function(){
 Route::post('job',[JobController::class,'search']);
 Route::post('talent',[TalentController::class,'search']);
 Route::post('user',[UserController::class,'search']);
 Route::post('category',[CategoryController::class,'search']);
});