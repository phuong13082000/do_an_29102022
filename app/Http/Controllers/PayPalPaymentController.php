<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;

class PayPalPaymentController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createTransaction()
    {
        return view('transaction');
    }

    public function processTransaction(Request $request)
    {
        $order = Order::where('customer_id', Session::get('id'))
            ->where('status', 1)
            ->where('payment_method', 'Trả bằng thẻ ngân hàng')
            ->orderBy('created_at', 'DESC')
            ->first();

        $order_details = OrderDetail::with('reProduct')
            ->where('order_id', $order->id)
            ->get();

        $total = 0;
        foreach ($order_details as $order_detail) {
            $subtotal = $order_detail->price * $order_detail->number;
            $total += $subtotal;
        }
        $fee_ship = ($total + $order->price_ship) / 25000;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $fee_ship,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('handcash')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('handcash')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('handcash')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('handcash')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('handcash')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
