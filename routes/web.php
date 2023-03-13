<?php
use Laboiteacode\RGPDManager\Http\Controllers\ConsentsController;
use Laboiteacode\RGPDManager\Http\Controllers\ContactController;

if( config('rgpdmanager.enable_contact') ) {
    Route::middleware('web')->get(config('rgpdmanager.routes.contact_route'), [ContactController::class , 'index'])->name('contact');
}

Route::prefix(config('rgpdmanager.routes.terms_prefix'))->name('rgpd-manager')->middleware('web')->group(function() {
    Route::get('/', [ConsentsController::class, 'index'])->name('.index');
    Route::get(config('rgpdmanager.routes.consents_prefix'), [ConsentsController::class, 'consents'])->name('.consents');
    Route::get(config('rgpdmanager.routes.contact_prefix') . '/{slug}', [ConsentsController::class, 'contact'])->name('.contact');
    Route::get('/details/{token}-{slug}', [ConsentsController::class, 'details'])->name('.details');
    Route::get('/{slug}', [ConsentsController::class, 'page'])->name('.page');
});
