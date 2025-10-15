<?php

namespace App\Http\Controllers\Dashboard;

use App\Checkout;
use App\CheckoutResult;
use App\Course;
use App\Http\Controllers\Controller;
use App\Order;
use App\Payment;
use App\Role;
use App\Score;
use App\Angizesh;
use App\Scoring;
use App\Session;
use App\Setting;
use App\Shop;
use App\Transaction;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //

    /*
     * POST /
     * create a order (if its exists it finds its id)
     */
    public function createOrder(Request $request) {

        $request->validate([
            'price' => ['required'],
            'shop_id' => ['required'],
        ]);

        $order = new Order();
        $order->status = Order::STATUS_CREATED;
        $order->shop_id = $request->shop_id;
        $order->user_id = Auth::user()->id;
        $order->price = $request->price;
        $order->save();

        return redirect()->route('order.details' ,['orderId' => $order->id]);

    }

    /*
     * GET /
     * list of orders
     */
    public function orderList(Request $request) {
        if (isset($request->shop_id)) {
            $role = 'shop';
            $orderList = Order::where('shop_id', $request->shop_id)->orderBy('id', 'DESC')->get();
        } else {
            $role = 'user';
            $orderList = Order::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        }

        return view('management.order.list' , compact('orderList', 'role'));
    }

    /*
     * GET /{id}
     * show an order details
     */
    public function view($id) {
        $order = Order::find($id);

        if ($order->status == Order::STATUS_PENDING_CHECKOUT) {
            $this->checkoutOrder($id);
        }

        // check if wallet transaction is created or not; if not do it
        $transaction = $order->transactions->first();
        if (!$transaction) {
            $walletDecrement = round($order->price * 15 / 100);
            if ($order->user->wallet < $walletDecrement) {
                $walletDecrement = $order->user->wallet;
            }
            $paymentPrice = $order->price - $walletDecrement;
        } else {
            $walletDecrement = abs($order->transactions->first()->price);
            $paymentPrice = $order->price - $walletDecrement;
        }

        if (Auth::user()->id == $order->shop->user_id) {
            $role = 'shop';
        } else {
            $role = 'user';
        }

        $paymentPrice = $order->price - $walletDecrement;

        return view('management.order.view' , compact('order' , 'walletDecrement' , 'paymentPrice', 'role'));
    }

    /*
     * POST /{id}/pay-request
     */
    public function payRequest($id) {

        $order = Order::find($id);

        // check if wallet transaction is created or not; if not do it
        $transaction = $order->transactions->first();
        if (!$transaction) {
            $walletDecrement = round($order->price * 15 / 100);
            if ($order->user->wallet < $walletDecrement) {
                $walletDecrement = $order->user->wallet;
            }
            $paymentPrice = $order->price - $walletDecrement;

            $result = Transaction::makeTransaction($order->user, Transaction::TYPE_BUY_FROM_SHOP, -$walletDecrement, "پرداخت مبلغ سفارش: ".$id, $order->id);
            if (!$result->isSuccessful()){
                return back()->with('error', 'خطا: '.$result->getMessage());
            }
            $transaction = $result->getTransaction();
        } else {
            $walletDecrement = $order->transactions->first()->price;
            $paymentPrice = $order->price - $walletDecrement;
        }

        $payment = Payment::createPaymentToken($order, $paymentPrice,"پرداخت سفارش شماره: ".$order);
        if (!$payment){
            return back()->with('error', 'خطا: '.'ساخت درگاه با شکست مواجه شد!');
        }

        $paymentLink = "https://nextpay.org/nx/gateway/payment/".$payment->trans_id;
        return view('management.order.before_pay', compact('paymentLink'));

    }

    /*
     * commitment of paying
     * NOTE: this route will be called by nextpay
     */
    public function payCommit(Request $request) {
        $order = Order::findOrFail($request->order_id);
        $payment = $order->payments->where('trans_id', $request->trans_id)->first();

        $isSuccess = false;
        $message = '';

        $v = $payment->verifyPayment();
        if (!$v) {
            $isSuccess = false;
            $message = 'تایید تراکنش با خطا مواجه شد!';
        } else {
            $isSuccess = $payment->isSuccessful();
            $message = $payment->getCodeMessage();
        }

        if ($isSuccess) {
            $order->status = Order::STATUS_PENDING_CHECKOUT;
            $order->save();
        }

        $this->checkoutOrder($order->id);

        return view('management.order.pay_result', compact('order', 'isSuccess', 'message'));
    }

    /*
     * GET {id}/cancel
     * cancel a order and return back the wallet transactions;
     */
    public function cancelOrder($id) {
        $order = Order::findOrFail($id);
        if ($order->status == Order::STATUS_CLOSED) {
            return back()->with('error', 'سفارش تکمیل شده، قابل لغو شدن نمیباشد.');
        }

        $correctivePrice = -$order->transactions->sum('price');
        if ($correctivePrice <> 0) {
            $result = Transaction::makeTransaction($order->user, Transaction::TYPE_CORRECTIVE, $correctivePrice, "اصلاحیه: لغو شدن سفارش: ".$id, $id);
            if (!$result->isSuccessful()) {
                return back()->with('error', 'خطا: '.$result->getMessage());
            }
        }

        $order->status = Order::STATUS_CANCELED;
        $order->save();
        return back();
    }

    /*
     * Checkout shop price
     */
    public function checkoutOrder($orderId) {
        $order = Order::find($orderId);

        if ($order->status != Order::STATUS_PENDING_CHECKOUT) {
            return back()->with('error', 'سفارش قابل تصفیه نمی باشد!');
        }

        $result = Checkout::makeCheckout($order);
        if ($result->status == CheckoutResult::STATUS_NOTHING_PAY) {
            return back()->with('error', 'مبلغی برای تصفیه نمی باشد!');
        } elseif ($result->status == CheckoutResult::STATUS_ERROR) {
            return back()->with('error', $result->message);
        }

        if ($result->status == CheckoutResult::STATUS_SUCCESS && $result->checkout->code == Checkout::STATUS_SUCCESS){
            $order->status = Order::STATUS_CLOSED;
            return back()->with('error', 'سفارش تکمیل شد!');
        }

        return back()->with('error', 'تصفیه انجام نشد!');
    }

}
