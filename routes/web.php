<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LofyController;


Route::get('/',[LofyController::class,'all_categories'])->name('categories.index');
Route::get('/contact',[LofyController::class,'contact'])->name('contact');


Route::prefix('lofies')->name('lofy.')->group(function(){

        Route::prefix('tracks')->name('tracks.')->group(function(){

            Route::get('/',[LofyController::class,'all_tracks'])->name('index');

            Route::get('/news',[LofyController::class,'recents_tracks'])->name('recents');
            Route::get('/olds',[LofyController::class,'old_tracks'])->name('olds');
            Route::get('/search',[LofyController::class,'search_track'])->name('search');

            Route::get('/{track_id}/details',[LofyController::class,'track_details'])->name('details');
        });

        Route::prefix('categories')->name('categories.')->group(function(){

            Route::get('/',[LofyController::class,'categories'])->name('index');

            Route::get('/recents', [LofyController::class, 'recent_categories'])->name('recents');
            Route::get('/olds', [LofyController::class, 'old_categories'])->name('olds');
            Route::get('/{category_id}/details',[LofyController::class,'category_details'])->name('details');
        });

        Route::prefix('artists')->name('artists.')->group(function(){

            Route::get('/',[LofyController::class,'all_artists'])->name('index');
            Route::get('/artists/{artist_id}', [LofyController::class, 'artist_details'])->name('details');

        });

        Route::get('/search',[LofyController::class,'search'])->name('search');

});



