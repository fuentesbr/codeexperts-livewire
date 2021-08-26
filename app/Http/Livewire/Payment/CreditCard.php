<?php

namespace App\Http\Livewire\Payment;

use App\Services\PagSeguro\Subscription\SubscriptionService;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class CreditCard extends Component
{
    public $sessionId;

    protected $listeners = [
        'paymentData' => 'proccessSubscription'
    ];

    public function mount()
    {
        $email = config('pagseguro.email');
        $token = config('pagseguro.token');
        $url = "https://ws.sandbox.pagseguro.uol.com.br/sessions/?email={$email}&token={$token}";
        $response = Http::post($url);
        $response = simplexml_load_string($response->body());

        $this->sessionId = (string) $response->id;
    }

    public function proccessSubscription($data)
    {
        $data['plan_reference'] = '6B2E28012929E4ACC4637FB8255BE6B2';
        $makeSubscription = (new SubscriptionService($data))->makeSubscription();

        dd($makeSubscription);
    }


    public function render()
    {
        return view('livewire.payment.credit-card')->layout('layouts.front');
    }
}
