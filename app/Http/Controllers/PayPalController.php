<?php
/**
 * File name: PayPalController.php
 * Last modified: 2020.06.11 at 16:10:52
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Http\Controllers;

use App\Models\Payment;
use Flash;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PayPalController extends ParentOrderController
{
    /**
     * @var ExpressCheckout
     */
    protected $provider;

    public function __init()
    {
        $this->provider = new ExpressCheckout();

    }

    public function index()
    {
        return view('welcome');
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getExpressCheckout(Request $request)
    {
        $user = $this->userRepository->findByField('api_token', $request->get('api_token'))->first();
        $coupon = $this->couponRepository->findByField('code', $request->get('coupon_code'))->first();
        $deliveryId = $request->get('delivery_address_id');
        if (!empty($user)) {
            $this->order->user = $user;
            $this->order->user_id = $user->id;
            $this->order->delivery_address_id = $deliveryId;
            $this->coupon = $coupon;
            $payPalCart = $this->getCheckoutData();
            try {
                $response = $this->provider->setExpressCheckout($payPalCart);
                if (!empty($response['paypal_link'])) {
                    return redirect($response['paypal_link']);
                } else {
                    Flash::error($response['L_LONGMESSAGE0']);
                }
            } catch (\Exception $e) {
                Flash::error("Error processing PayPal payment for your order :" . $e->getMessage());
            }
        }
        return redirect(route('payments.failed'));
    }

    /**
     * Set cart data for processing payment on PayPal.
     *
     *
     * @return array
     */
    private function getCheckoutData()
    {
        $data = [];
        $this->calculateTotal();
        $order_id = $this->paymentRepository->all()->count() + 1;
        $data['items'][] = [
            'name' => $this->order->user->cart[0]->food->restaurant->name,
            'price' => $this->total,
            'qty' => 1,
        ];
        $data['total'] = $this->total;
        $data['return_url'] = url("payments/paypal/express-checkout-success?user_id=" . $this->order->user_id . "&delivery_address_id=" . $this->order->delivery_address_id);

        if (isset($this->coupon)) {
            $data['return_url'] .= "&coupon_code=" . $this->coupon->code;
        }
        $data['cancel_url'] = url('payments/paypal');
        $data['invoice_id'] = $order_id . '_' . date("Y_m_d_h_i_sa");
        $data['invoice_description'] = $this->order->user->cart[0]->food->restaurant->name;

        //dd($data);
        return $data;
    }

    /**
     * Process payment on PayPal.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function getExpressCheckoutSuccess(Request $request)
    {
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $this->order->user_id = $request->get('user_id', 0);
        $this->order->user = $this->userRepository->findWithoutFail($this->order->user_id);
        $this->coupon = $this->couponRepository->findByField('code', $request->get('coupon_code'))->first();
        $this->order->delivery_address_id = $request->get('delivery_address_id', 0);

        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);
        $payPalCart = $this->getCheckoutData();

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            // Perform transaction on PayPal
            $paymentStatus = $this->provider->doExpressCheckoutPayment($payPalCart, $token, $PayerID);
            $this->order->payment = new Payment();
            $this->order->payment->status = $paymentStatus['PAYMENTINFO_0_PAYMENTSTATUS'];
            $this->order->payment->method = 'PayPal';

            $this->createOrder();

            return redirect(url('payments/paypal'));
        } else {
            Flash::error("Error processing PayPal payment for your order");
            return redirect(route('payments.failed'));
        }
    }
}
