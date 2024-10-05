<?php

use App\Events\AdminNotification;
use App\Events\Example;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


Route::get('/',function(){
    return redirect()->route('login');
});
Route::get('/login', function(){
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }
    return view('login');
})->name('login');
Route::post('/login', function(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);
    Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }
    else{
        return redirect()->back();
    }
})->name('login.post');

Route::get('/signup', function(){
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }
    return view('signup');
})->name('signup');
Route::post('/signup', function(Request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required|confirmed',
        'password_confirmation'=>'required'
    ]);
    User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password)
    ]);
    Auth::attempt(['email' => $request->email, 'password' => $request->password]);
    if(Auth::check()){
        return redirect()->route('dashboard.index');
    }
    else{
        return redirect()->back();
    }
})->name('signup.post');




Route::get('/broadcast', function () {
    $user = User::find(1);
    broadcast(new Example($user));
});


Route::middleware(\App\Http\Middleware\AuthCheck::class)->group(function(){
    Route::get('/dashboard', function(){
        return view('dashboard.index');
    })->name('dashboard.index');

    Route::post('/send-admin-notification',function(){
        try {
            broadcast(new AdminNotification(Auth::user()));
            return response()->json([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
            ]);
        }
    })->name('sendAdminNotification');

    Route::get('/logout', function(){
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});
