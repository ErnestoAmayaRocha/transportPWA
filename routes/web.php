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

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasazules')->name('rutasazules/')->group(static function() {
            Route::get('/',                                             'RutasazulesController@index')->name('index');
            Route::get('/create',                                       'RutasazulesController@create')->name('create');
            Route::post('/',                                            'RutasazulesController@store')->name('store');
            Route::get('/{rutasazule}/edit',                            'RutasazulesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasazulesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasazule}',                                'RutasazulesController@update')->name('update');
            Route::delete('/{rutasazule}',                              'RutasazulesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasrojas')->name('rutasrojas/')->group(static function() {
            Route::get('/',                                             'RutasrojasController@index')->name('index');
            Route::get('/create',                                       'RutasrojasController@create')->name('create');
            Route::post('/',                                            'RutasrojasController@store')->name('store');
            Route::get('/{rutasroja}/edit',                             'RutasrojasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasrojasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasroja}',                                 'RutasrojasController@update')->name('update');
            Route::delete('/{rutasroja}',                               'RutasrojasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasverdes')->name('rutasverdes/')->group(static function() {
            Route::get('/',                                             'RutasverdesController@index')->name('index');
            Route::get('/create',                                       'RutasverdesController@create')->name('create');
            Route::post('/',                                            'RutasverdesController@store')->name('store');
            Route::get('/{rutasverde}/edit',                            'RutasverdesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasverdesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasverde}',                                'RutasverdesController@update')->name('update');
            Route::delete('/{rutasverde}',                              'RutasverdesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutaverdes')->name('rutaverdes/')->group(static function() {
            Route::get('/',                                             'RutaverdesController@index')->name('index');
            Route::get('/create',                                       'RutaverdesController@create')->name('create');
            Route::post('/',                                            'RutaverdesController@store')->name('store');
            Route::get('/{rutaverde}/edit',                             'RutaverdesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutaverdesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutaverde}',                                 'RutaverdesController@update')->name('update');
            Route::delete('/{rutaverde}',                               'RutaverdesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasamarillas')->name('rutasamarillas/')->group(static function() {
            Route::get('/',                                             'RutasamarillasController@index')->name('index');
            Route::get('/create',                                       'RutasamarillasController@create')->name('create');
            Route::post('/',                                            'RutasamarillasController@store')->name('store');
            Route::get('/{rutasamarilla}/edit',                         'RutasamarillasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasamarillasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasamarilla}',                             'RutasamarillasController@update')->name('update');
            Route::delete('/{rutasamarilla}',                           'RutasamarillasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('users')->name('users/')->group(static function() {
            Route::get('/',                                             'UsersController@index')->name('index');
            Route::get('/create',                                       'UsersController@create')->name('create');
            Route::post('/',                                            'UsersController@store')->name('store');
            Route::get('/{user}/edit',                                  'UsersController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsersController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}',                                      'UsersController@update')->name('update');
            Route::delete('/{user}',                                    'UsersController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('usuarios')->name('usuarios/')->group(static function() {
            Route::get('/',                                             'UsuariosController@index')->name('index');
            Route::get('/create',                                       'UsuariosController@create')->name('create');
            Route::post('/',                                            'UsuariosController@store')->name('store');
            Route::get('/{usuario}/edit',                               'UsuariosController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsuariosController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{usuario}',                                   'UsuariosController@update')->name('update');
            Route::delete('/{usuario}',                                 'UsuariosController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('usuariosses')->name('usuariosses/')->group(static function() {
            Route::get('/',                                             'UsuariossController@index')->name('index');
            Route::get('/create',                                       'UsuariossController@create')->name('create');
            Route::post('/',                                            'UsuariossController@store')->name('store');
            Route::get('/{usuarioss}/edit',                             'UsuariossController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'UsuariossController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{usuarioss}',                                 'UsuariossController@update')->name('update');
            Route::delete('/{usuarioss}',                               'UsuariossController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasnaranjas')->name('rutasnaranjas/')->group(static function() {
            Route::get('/',                                             'RutasnaranjasController@index')->name('index');
            Route::get('/create',                                       'RutasnaranjasController@create')->name('create');
            Route::post('/',                                            'RutasnaranjasController@store')->name('store');
            Route::get('/{rutasnaranja}/edit',                          'RutasnaranjasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasnaranjasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasnaranja}',                              'RutasnaranjasController@update')->name('update');
            Route::delete('/{rutasnaranja}',                            'RutasnaranjasController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasnaranjasses')->name('rutasnaranjasses/')->group(static function() {
            Route::get('/',                                             'RutasnaranjassController@index')->name('index');
            Route::get('/create',                                       'RutasnaranjassController@create')->name('create');
            Route::post('/',                                            'RutasnaranjassController@store')->name('store');
            Route::get('/{rutasnaranjass}/edit',                        'RutasnaranjassController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasnaranjassController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasnaranjass}',                            'RutasnaranjassController@update')->name('update');
            Route::delete('/{rutasnaranjass}',                          'RutasnaranjassController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function() {
        Route::prefix('rutasblancas')->name('rutasblancas/')->group(static function() {
            Route::get('/',                                             'RutasblancasController@index')->name('index');
            Route::get('/create',                                       'RutasblancasController@create')->name('create');
            Route::post('/',                                            'RutasblancasController@store')->name('store');
            Route::get('/{rutasblanca}/edit',                           'RutasblancasController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'RutasblancasController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{rutasblanca}',                               'RutasblancasController@update')->name('update');
            Route::delete('/{rutasblanca}',                             'RutasblancasController@destroy')->name('destroy');
        });
    });
});