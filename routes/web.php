<?php

use App\WebSockets\Handler\DriverLocationSocketHandler;
use BeyondCode\LaravelWebSockets\Facades\WebSocketsRouter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('socket', function (){
    return view('test');
});

Route::post('socket-serve', function (Request $request){
    $command = 'websockets:serve';
    if (!is_null($request['host'])) {
        $command = $command." --host=". $request['host'];
    }
    if (!is_null($request['port'])) {
        $command = $command." --port=". $request['port'];
    }

    try {
        Artisan::call($command);
    } catch (\Exception $e)
    {
        return back();
    }

    return back();

//    dump('connected');
})->name('socket-serve');

WebSocketsRouter::webSocket('/driver/live-location', DriverLocationSocketHandler::class);

