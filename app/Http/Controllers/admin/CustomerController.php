<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    //admin
    public function show_customer()
    {
        $title = 'Customer';
        $list_Customer = Customer::all();
        $count_message = Comment::where('status', 1)->where('comment_parent_id', NULL)->count();
        $messages = Comment::with('reCustomer')->where('status', 1)->where('comment_parent_id', NULL)->get();

        return view('admin.pages.customer.index')->with(compact('title', 'list_Customer', 'count_message', 'messages'));
    }

    //user
    public function dangnhap()
    {
        $title = 'Login';
        $list_brand = Brand::take(5)->get();

        return view('frontend.pages.login')->with(compact('title', 'list_brand'));
    }

    public function dangki()
    {
        $title = 'Register';
        $list_brand = Brand::take(5)->get();

        return view('frontend.pages.register')->with(compact('title', 'list_brand'));
    }

    public function profile()
    {
        $title = 'Profile';
        $list_brand = Brand::take(5)->get();

        $customer = Customer::find(Session::get('id'));
        $history_orders = Order::where('customer_id', Session::get('id'))->orderBy('created_at', 'DESC')->get();

        return view('frontend.pages.profile')->with(compact('title', 'list_brand', 'customer', 'history_orders'));
    }

    public function change_password_user(Request $request)
    {
        $password_new_1 = $request['password_new'];
        $password_new_2 = $request['re_password_new'];

        $customer = Customer::find(Session::get('id'));
        $check_password = Hash::check($request['password'], $customer->password ?? '');

        if($check_password && $password_new_1 == $password_new_2){
            $customer->password = Hash::make($password_new_1);
            $customer->save();
            return redirect()->back()->with('success','Change password success');
        }
        return redirect()->back()->with('error','Change password error');
    }

    public function update_profile(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => ['max:255'],
            'phone' => ['max:11'],
            'address' => ['string', 'max:255'],
        ]);

        if ($validated->fails()) {
            return response()->json(['code' => 400, 'msg' => $validated->errors()->first()]);
        }

        $customer = Customer::find(Session::get('id'));
        $customer->fullname = $request['name'];
        $customer->phone = $request['phone'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->save();

        $user = Customer::where('email', $request['email'])->first();

        Session::put('id', $user->id);
        Session::put('name', $user->fullname);
        Session::put('email', $user->email);
        Session::put('phone', $user->phone);
        Session::put('address', $user->address);
        return response()->json(['code' => 200, 'msg' => 'Cập nhật thông tin cá nhân thành công']);
    }

    public function login_customer(Request $request)
    {
        $customer = Customer::where('email', $request->email_login)->first();

        $check_password = Hash::check($request->password_login, $customer->password ?? '');

        if ($customer && $check_password) {
            Session::put('id', $customer->id);
            Session::put('name', $customer->fullname);
            Session::put('email', $customer->email);
            Session::put('address', $customer->address);
            Session::put('phone', $customer->phone);

            return redirect('/')->with('success', 'Đăng nhập thành công');
        } else {
            return redirect('/dang-nhap')->with('error', 'Đăng nhập không thành công');
        }
    }

    public function add_customer(Request $request)
    {
        $data = $request->all();

        $customer = new Customer();
        $customer->fullname = $data['fullname'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'];
        $customer->password = Hash::make($data['password']);
        $customer->save();

        $user = Customer::where('email', $data['email'])->first();

        Session::put('id', $user->id);
        Session::put('name', $user->fullname);
        Session::put('email', $user->email);
        Session::put('phone', $user->phone);

        return redirect('/')->with('success', 'Đăng kí thành công');
    }

    public function logout()
    {
        Session::forget('id');
        Session::forget('name');
        Session::forget('email');
        Session::forget('phone');
        return redirect('/');
    }

    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    function createUserFacebook($getInfo)
    {
        $user = Customer::where('facebook_id', $getInfo->id)->first();
        if (!$user) {
            $user = Customer::create([
                'fullname' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => 'facebook',
                'facebook_id' => $getInfo->id
            ]);
        }
        return $user;
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Customer::where('provider', 'facebook')->where('facebook_id', $provider->getId())->first();

        if (!$account) {
            $this->createUserFacebook($provider);
        }

        $account_name = Customer::where('facebook_id', $account->facebook_id)->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('message', 'Đăng nhập thành công');
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    function createUserGoogle($getInfo)
    {
        $user = Customer::where('google_id', $getInfo->id)->first();
        if (!$user) {
            $user = Customer::create([
                'fullname' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => 'google',
                'google_id' => $getInfo->id
            ]);
        }
        return $user;
    }

    public function callback_google()
    {
        $provider = Socialite::driver('google')->stateless()->user();
        $account = Customer::where('provider', 'google')->where('google_id', $provider->getId())->first();

        if (!$account) {
            $this->createUserGoogle($provider);
        }
        $account_name = Customer::where('google_id', $account->id)->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('message', 'Đăng nhập thành công');
    }

}
