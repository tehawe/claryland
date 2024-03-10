<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class WAController extends Controller
{
    public function index(Order $order)
    {
        $token = 'z7xenUt@GWPe@6jB-YdN';
        $target = $order->customer_contact;

        $transaksi = Order::where('invoice', $order->invoice)->firstOrFail();
        if ($transaksi) {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.fonnte.com/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => array(
                    'target' => $target,
                    'countryCode' => '62',
                    'message' => '
_*Hi Mom/Dad ' . $order->customer_name . '*_

Anda baru saja bertransaksi di Claryland Playground.
Invoice *' . $order->invoice . '*
Total *Rp' . number_format($order->total) . '*

Cek untuk melihat detail transaksi anda:
https://clarylandplayground.com/invoice/' . $order->invoice . '

Thanks & Have Fun
_*Claryland Playground*_
                ',
                ),
                CURLOPT_HTTPHEADER => array(
                    "Authorization: $token" //change TOKEN to your actual token
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return redirect()->route('orders.show', ['order' => $order->invoice]);
        } else {
            return back();
        }
    }
}
