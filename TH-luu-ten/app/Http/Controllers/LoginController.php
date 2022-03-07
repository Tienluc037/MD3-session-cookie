<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Lấy thông tin đang nhập từ request gửi lên từ trình duyệt
        $username = $request->inputUsername;
        $password = $request->inputPassword;

        // Kiểm tra thông tin đăng nhập
        if ($username == 'admin' && $password == '123456') {

            //Nếu thông tin đăng nhập chính xác, Tạo một Session xác nhận đăng nhập thành công
            $request->session()->push('login', true);
//Với câu lệnh: $request->session()->push('login', true); Sẽ tạo ra một biến Session có key là login và giá trị bằng true, khi ta sử dụng push() biến Session này sẽ tồn tại liên tục cho đến người dùng logout (xóa Session) hoặc khi người dùng tắt trình duyệt thì session này sẽ bị xóa, đồng nghĩa với việc kết thúc phiên đăng nhập.
//
//Với câu lệnh: $request->session()->flash('login-fail', $message); Thì sẽ tạo ra 1 biến Session có key là login-fail và có giá trị là chuỗi thông báo, khi ta sử dụng flash() thì biến session này sẽ chỉ tồn tại duy nhất một lần trong lần truy xuất tiếp theo sau đó sẽ tự động xóa ngay. Có nghĩa là ta sẽ chỉ hiển thị thông báo trong biến session này 1 lần duy nhất ở ngoài view sau đó sẽ tự động xóa luôn.


            // Đi đến route show.blog, để chuyển hướng người dùng đến trang blog
            return redirect()->route('show.blog');
        }

        // Nếu thông tin đăng nhập không chính xác, gán thông báo vào Session
        $message = 'Đăng nhập không thành công. Tên người dùng hoặc mật khẩu không đúng.';
        $request->session()->flash('login-fail', $message);

        //Quay trở lại trang đăng nhập
        return view('login');
    }

}
