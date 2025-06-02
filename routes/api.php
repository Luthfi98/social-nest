// Auth Routes
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/verify-email/{token}', [App\Http\Controllers\Auth\RegisterController::class, 'verifyEmail']); 