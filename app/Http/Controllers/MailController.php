<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function admin_forget_password()
    {
        $title = 'Forget Password';

        return view('admin.auth.quen-mat-khau')->with(compact('title'));
    }

    public function admin_update_new_password()
    {
        $title = 'Update New Password';

        return view('admin.auth.update-new-password')->with(compact('title'));
    }

    public function admin_recover_password(Request $request)
    {
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $title_mail = "Lấy lại mật khẩu admin" . ' ' . $now;
        $email = $data['email'];

        //so sanh voi email trong database
        $admin = Admin::where('email', $email)->get();
        foreach ($admin as $key => $value) {
            $admin_id = $value->admin_id;
        }
        if ($admin) {
            $count_admin = $admin->count();
            if ($count_admin == 0) {
                return redirect()->back()->with('error', 'Email không có trong CSDL');
            } else {
                $token_random = Str::random();
                $admin = Admin::find($admin_id);
                $admin->token = $token_random;
                $admin->save();

                //send mail
                $link_reset_password = url('/admin/update-new-password?email=' . $email . '&token=' . $token_random);

                $data = ["name" => $title_mail, "body" => $link_reset_password, "email" => $data['email']];  //layout mail.blade.php

                Mail::send('admin.auth.mail', ['data' => $data], function ($message) use ($title_mail, $data) {
                    $message->to($data['email'])->subject($title_mail); //send mail w subject
                    $message->from($data['email'], $title_mail); //send from this mail
                });

                return redirect('admin/login')->with('success', 'Gửi mail thành công, vui lòng vào email để reset password');
            }
        }
    }

    public function admin_reset_new_password(Request $request)
    {
        $data = $request->all();
        $token_random = Str::random();
        $email = $data['email'];
        $token = $data['token'];
        $password = $data['password'];

        $admin = Admin::where('email', $email)->where('token', $token)->get();
        $count = $admin->count();
        if ($count > 0) {
            foreach ($admin as $key => $value) {
                $admin_id = $value->admin_id;
            }
            $reset = Admin::find($admin_id);
            $reset->password = md5($password);
            $reset->token = $token_random;
            $reset->save();
            return redirect('admin/login')->with('success', 'Mật khẩu đã cập nhật, Vui lòng đăng nhập');
        } else {
            return redirect('admin/quen-mat-khau')->with('error', 'Vui lòng nhập lại email vì link quá hạn');
        }
    }

}