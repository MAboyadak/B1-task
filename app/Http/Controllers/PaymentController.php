<?php

namespace App\Http\Controllers;

use App\Services\FatoorahService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private array $invoiceItems;
    private FatoorahService $fatoorahService;

    public function __construct(FatoorahService $service){
        
        $this->fatoorahService = $service;

    }

    public function createPayment(){
        return view('payment.create');
    }

    public function checkout(){
        
        // Simulation for getting Customer data and paid items

        $this->invoiceItems[] = [
            'ItemName'  => 'Item One',
            'Quantity'  => '2',
            'UnitPrice' => '50',
        ];
        
        $data = [
            'customerName'          => 'Mohamed Hamdy',
            'NotificationOption'    => 'Lnk',
            'InvoiceValue'          => '100',
            'CutsomerEmail'         => 'mohamedhamdy9711@gmail.com',
            'CallBackUrl'           => env('PAYMENT_SUCCESS_URL'),
            'ErrorUrl'              => env('PAYMENT_ERROR_URL'),
            'Language'              => 'en',
            'DisplayCurrencyIso'    => 'EGP',
            'InvoiceItems'          => $this->invoiceItems,
        ];

        $response = $this->fatoorahService->sendPayment($data);

        $url = ($response['Data']['InvoiceURL']);
        return redirect("$url");
    }

    // public function onSuccess(){
    //     return 'Success';
    // }

    // public function onError(){
    //     return 'Error';
    // }
}
