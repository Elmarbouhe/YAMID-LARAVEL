<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

use function PHPSTORM_META\argumentsSet;
use function Termwind\render;

class PaymentController extends Controller
{
    //
    // public function __construct(){
    //    Auth::check();
    // }

    // public function handlePayment(){
    //      $data = [];
    //     $data['items'] = [];

    //     foreach(\cart::getContent() as $item){
    //        array_push($data['items'], [
    //            'name' => $item->name,
    //            'price' => (int) ($item->price /9),
    //            'desc' => $item->associatedModel->description,
    //            'quantity' => $item->quantity
    //        ]);
    //     }

    //     $data['invoice_id'] = auth()->user()->id;
    //     $data['invoice_description'] = "Commande #{$data['invoice_id']}";
    //     $data['return_url'] = route('success.payment');
    //     $data['cancel_url'] = route('cancel.payment');

    //     $total = 0;
    //     foreach($data['items'] as $item){
    //         $total += $item['price'] * $item['quantity'];
    //     }

    //     $data['total'] = $total;
    //     $paypalModule = new ExpressCheckout;





    // }






    // private $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_SECRET'));
        $this->gateway->setTestMode(true);
    }

    public function pay(Request $request)
    {
        try{
            $response = $this->gateway->purchase(array(
                'amount' => $request->amount,
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('PAYPAL_CURRENCY'),
                'cancelUrl' => url('error')
            ))->send();

            if($response->isRedirect()){
                $response->redirect();
            }else{
                return $response->getMessage();
            }
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }

    public function success(Request $request){

        if($request->input('paymentId') && $request->input('PayerID')){
            $transacton = $this->gateway->completePurchase(array(
                'payer_id' => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId')
            ));

            $response = $transacton->send();


        if($response->isSuccessful()){
                $data = $response->getData();

                $payment = new Payment();
                $payment->payment_id = $data['id'];
                $payment->payer_id = $data['payer']['payer_info']['payer_id'];
                $payment->payer_email = $data['payer']['payer_info']['email'];
                $payment->amount = $data['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $data['state'];

                $payment->save();

                return redirect()->route('cart.index')->with('success', 'Transaction réussie');
        }else{

                return $response->getMessage();
        }
        }
        else{
                return 'Transaction et non réussie';
            }
    }


    public function error(){
            return 'cliente a annulé la transaction';
    }




}

