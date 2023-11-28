<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User,Order};
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Classes\UserCrypt;


class ProfileController extends Controller
{
    public function show($encrypted){
        $user = user::where('id', UserCrypt::decriptedId($encrypted))->first();

        return view('profile.show', [
            'user' => $user,
        ]);
    }

    public function info(User $user) {
        return view('profile.info',[
            'user' => $user,
        ]);
    }

    public function infoUpdate(UpdateUserRequest $request, User $user){
        // dd($request->all());
        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'selfship' => $request->filled('selfship') ? 1 : 0,
            'new_post_num' => $request->new_post_num,
            'new_post_city' => $request->new_post_city,
            'new_post_adress' => $request->new_post_adress,
        ]);

        // if ($user->save()) {
        //     toastr()->success('Your profile updated success!');
        // }else{
        //     toastr()->error('An error has occurred please try again later.');
        // }
        // toastr()->success('Your profile has been updated success!');
        return redirect()->back()->with('status', 'Ваш профіль успішно оновлено!');
    }

    public function orders(User $user) {

        return view('profile.orders',[
            'user' => $user,
        ]);
    }

    public function return(Request $request, User $user) {

        return view('profile.return',[
            'user' => $user,
        ]);
    }

    public function password(User $user) {

        return view('profile.password',[
            'user' => $user,
        ]);
    }

    public function passwordUpdate(Request $request, User $user) {
        // Валидация входных данных
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Проверка соответствия старого пароля
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with("error", "Старий пароль невірний!");
        }

        // Обновление пароля
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);
        return back()->with('status', 'Пароль успішно змінено!');
        // Отправка сообщения об успешном обновлении
        toastr()->success('Ваш пароль було успішно змінено!');
        return redirect()->back();
    }

    public function orderShow(User $user, Order $order) {

        return view('profile.orderShow',[
            'user' => $user,
            'order' => $order,
        ]);
    }
}
