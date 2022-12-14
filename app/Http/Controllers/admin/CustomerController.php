<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Services\CustomerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    //admin
    public function show_customer()
    {
        $title = 'Customer';
        $count_message = Comment::where('status', 1)
            ->where('comment_parent_id', NULL)->count();

        $messages = Comment::with('reCustomer')
            ->where('status', 1)
            ->where('comment_parent_id', NULL)->get();

        $listCustomer = Customer::all();

        return view('admin.pages.customer.index')->with(compact('title', 'listCustomer', 'count_message', 'messages'));
    }

    //user
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function dangnhap()
    {
        $title = 'Login';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        return view('frontend.pages.login')->with(compact('title', 'list_brand'));
    }

    public function dangki()
    {
        $title = 'Register';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        return view('frontend.pages.register')->with(compact('title', 'list_brand'));
    }

    public function profile()
    {
        $title = 'Profile';
        $list_brand = Brand::where('status', 0)->take(5)->get();

        $customer = Customer::find(Session::get('id'));

        $history_orders_status1 = Order::where('customer_id', Session::get('id'))->where('status', 1)->orderBy('created_at', 'DESC')->get();
        $history_orders_status2 = Order::where('customer_id', Session::get('id'))->where('status', 2)->orderBy('created_at', 'DESC')->get();
        $history_orders_status3 = Order::where('customer_id', Session::get('id'))->where('status', 3)->orderBy('created_at', 'DESC')->get();

        return view('frontend.pages.profile')->with(compact('title', 'list_brand', 'customer', 'history_orders_status1', 'history_orders_status2', 'history_orders_status3'));
    }

    public function profile_order_detail(Request $request)
    {
        $this->customerService->orderProfileDetail($request);
    }

    public function cancel_order(Request $request)
    {
        $this->customerService->cancelOrderUser($request);
    }

    public function change_password_user(Request $request)
    {
        $checkPassword = $this->customerService->changePasswordUser($request, Session::get('id'));

        if ($checkPassword) {
            return redirect()->back()->with('success', '?????i m???t kh???u th??nh c??ng');
        } else {
            return redirect()->back()->with('error', '?????i m???t kh???u kh??ng th??nh c??ng');
        }
    }

    public function update_profile(Request $request)
    {
        $updateProfile = $this->customerService->updateProfile($request, Session::get('id'));

        if ($updateProfile) {
            return redirect()->back()->with('success', 'C???p nh???t th??ng tin c?? nh??n th??nh c??ng');
        } else {
            return redirect()->back()->with('error', 'C???p nh???t th??ng tin c?? nh??n kh??ng th??nh c??ng');
        }
    }

    public function login_customer(Request $request)
    {
        $checkLogin = $this->customerService->loginCustomer($request);

        if ($checkLogin) {
            return redirect('/')->with('success', '????ng nh???p th??nh c??ng');
        } else {
            return redirect('/dang-nhap')->with('error', '????ng nh???p kh??ng th??nh c??ng');
        }
    }

    public function add_customer(Request $request)
    {
        $this->customerService->createCustomer($request);

        return redirect('/')->with('success', '????ng k?? th??nh c??ng');
    }

    public function logout()
    {
        Session::forget('id');
        Session::forget('name');
        Session::forget('email');
        Session::forget('phone');
        Session::forget('address');
        return redirect('/');
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();

        $account_before = Customer::where('provider', 'facebook')
            ->where('facebook_id', $provider->getId())->first();

        if (!$account_before) {
            Customer::create([
                'fullname' => $provider->name,
                'email' => $provider->email,
                'provider' => 'facebook',
                'facebook_id' => $provider->id
            ]);
        }
        $account_after = Customer::where('provider', 'facebook')
            ->where('facebook_id', $provider->getId())->first();

        $account_name = Customer::where('facebook_id', $account_after->facebook_id)
            ->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('success', '????ng nh???p th??nh c??ng');
    }

    public function callback_google()
    {
        $provider = Socialite::driver('google')->stateless()->user();

        $account_before = Customer::where('provider', 'google')
            ->where('google_id', $provider->getId())->first();

        if (!$account_before) {
            Customer::create([
                'fullname' => $provider->name,
                'email' => $provider->email,
                'provider' => 'google',
                'google_id' => $provider->id
            ]);
        }
        $account_after = Customer::where('provider', 'google')
            ->where('google_id', $provider->getId())->first();

        $account_name = Customer::where('google_id', $account_after->google_id)->first();

        Session::put('id', $account_name->id);
        Session::put('name', $account_name->fullname);
        return redirect('/')->with('success', '????ng nh???p th??nh c??ng');
    }

}
