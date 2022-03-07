<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showFormLogin(Request $request)
    {
        $email = '';
        $password = '';

        if ($request->cookie('email')){

            $email = $request->cookie('email');

            $password = $request->cookie('password');

        }

        return view('login', compact('email', 'password'));

    }

//showFormLogin() sẽ kiểm tra các cookie có được gửi kèm theo request hay không?
// Nếu có thì lấy dữ liệu email và password từ cookie để hiển thị ra form login. Lúc này người dùng sẽ không  phải điền lại tài khoản nữa

    function login(Request $request)

    {

        $data = $request->only(['email','password']);

        if (Auth::attempt($data)) {

            $cookie = cookie('email', $request->email);

            $cookiePassword = cookie('password', $request->password);

            return redirect()->route('home.index')->cookie($cookie)->cookie($cookiePassword);

        }
        return back();
        //login() sẽ thực hiện login vào hệ thống và tạo các cookie email và password, các cookie sẽ được gửi kèm theo response trả về cho client.
    }
}
