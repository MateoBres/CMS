<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function info_json()
    {
        $info = [
            'description' => "",
            'phone' => '',
            'email' => '',
            'min_order' => '',
            'zip_codes' => [],
            'social' => [
                'facebook' => '',
                'twitter' => '',
                'instagram' => ''
            ],
            'im' => [
                'whatsapp' => '',
                'fb_messenger' => '',
                'telegram' => ''
            ],
            'geo' => [
                'lat' => '',
                'geo' => ''
            ],
            'timeslots' => [
                [
                    'id' => 1,
                    'name' => 'Lunedì',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 2,
                    'name' => 'Martedì',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 3,
                    'name' => 'Mercoledì',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 4,
                    'name' => 'Giovedì',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 5,
                    'name' => 'Venerdì',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 6,
                    'name' => 'Sabato',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
                [
                    'id' => 7,
                    'name' => 'Domenica',
                    'delivery_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'takeaway_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                    'opening_hours' => [
                        [
                            'start' => '',
                            'end' => ''
                        ],
                    ],
                ],
            ]
        ];

        $info = json_encode($info);

        return $info;
    }

    public function initialize_info_fields()
    {
        $retailers = Retailer::all();

        try {
            foreach ($retailers as $retailer) {
                $info = $this->info_json();

                $retailer->info = $info;
                $retailer->save();
            }
            return $retailers;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_payments_to_info_field()
    {
        $retailers = Retailer::all();
        foreach ($retailers as $retailer) {
            $retailer_info = json_decode($retailer->info);
            $retailer_info->payments = [
                'cash' => [
                    'checked' => true,
                ],
                'card' => [
                    'checked' => false,
                    'stripe_key' => '',
                    'stripe_secret_key' => ''
                ],
                'transfer' => [
                    'checked' => false,
                    'iban_code' => '',
                    'name' => '',
                    'number' => '',
                    'bank' => '',
                    'notes' => ''
                ],
            ];
            $retailer_info = json_encode($retailer_info);
            $retailer->info = $retailer_info;
            $retailer->save();
        }
    }

    public function add_is_paid_to_delivery_info()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            if ($order->delivery_info) {
                $delivery_info = json_decode($order->delivery_info);
                $delivery_info->payment_info = [
                    'payment_type' => '',
                    'is_paid' => false,
                ];
                $order->delivery_info = json_encode($delivery_info);
                $order->save();
            }
        }
    }

    public function pay(Request $request)
    {
        $stripe_sk = $request->get('stripe_sk');
        \Stripe\Stripe::setApiKey($stripe_sk);

        $stripe_pk = $request->get('stripe_pk');
        $source = $request->get('source');
        $amount = $request->get('amount');
        $currency = $request->get('currency');
        $description = $request->get('description');
        try {
            $stripe = new \Stripe\StripeClient($stripe_sk);
            $transaction = $stripe->charges->create([
                'amount' => $amount,
                'currency' => $currency,
                'source' => $source,
                'description' => $description,
            ]);

            return response()->json([
                'success' => true,
                'data' => $transaction,
                'description' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'data' => $th,
                'description' => $th->getMessage()
            ], 200);
        }
    }

    public function checkout(Request $request) {
        $stripe_sk = $request->get('stripe_sk');
        \Stripe\Stripe::setApiKey($stripe_sk);

        $items = $request->get('items');
        $line_items = [];

        foreach ($items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'],
                ],
                'quantity' => $item['qty'],
            ];
        };

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'locale'=>'it',
            'success_url' => $request->get('success_url'),
            'cancel_url' => $request->get('cancel_url'),
        ]);
        
        return $session->id;
    }
}
