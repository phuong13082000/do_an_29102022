<?php

namespace App\Http\Controllers;

use App\Repositories\OrderDetailRepository;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;

class PayPalPaymentController extends Controller
{
    protected $orderService, $orderRepository, $orderDetailRepository;

    public function __construct(
        OrderRepository       $orderRepository,
        OrderService          $orderService,
        OrderDetailRepository $orderDetailRepository,
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderService = $orderService;
        $this->orderDetailRepository = $orderDetailRepository;
    }

    public function createTransaction()
    {
        return view('transaction');
    }

    public function processTransaction(Request $request)
    {
        $order = $this->orderRepository->findIDWhereCustomerId(Session::get('id'));
        $order_details = $this->orderDetailRepository->getOrderDetailWithProduct($order->id);
        $total = 0;
        foreach ($order_details as $order_detail){
            $subtotal = $order_detail->price * $order_detail->number;
            $total += $subtotal;
        }
        $fee_ship = ($total + $order->price_ship)/23000;

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
                        "value" => round($fee_ship, PHP_ROUND_HALF_UP), //PHP_ROUND_HALF_UP làm tròn 1,5->2
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
