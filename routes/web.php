<?php

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::view('/', 'welcome')->name('home');

Route::get('/users', function (Request $request) {
    $search_text = $request->name;

    $users = null;

    if (isset($search_text))
        $users = User::where('name', 'like', $search_text)
            ->whereNot('id', $request->user()->id)->get();
    else
        $users = User::whereNot('id', $request->user()->id)->get();

    return view('users', compact('users', 'search_text'));
})->name('users');

Route::get('/{id}/chat', function (Request $request, int $id) {
    $user = User::whereId($id)->first();
    $with = $user->id;

    $messages = Message::where(function ($query) use ($request, $with) {
        $query->where('from_user', $request->user()->id)->where('to_user', $with);
    })->orWhere(function ($query) use ($request, $with) {
        $query->where('from_user', $with)->where('to_user', $request->user()->id);
    })->get();

    return view('chat', compact('user', 'messages'));
})->name('chat');

Route::view('/profile', 'profile')->name('profile');
Route::put('/profile', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string',
        'email' => 'required|string|unique:users',
    ]);

    if ($validator->fails())
        return redirect()->back()->withInput()->withErrors($validator);

    User::whereId($request->user()->id)->update([
        'name' => $request->name,
        'email' => $request->email
    ]);

    return redirect()->back()->with('success', 'Profile updated successfully.');
})->name('update_profile');