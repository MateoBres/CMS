<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use App\Retailer;
use App\Mail\ContactsForm;
use App\Mail\OrderDispatched;
use App\Mail\OrderReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $orders = Order::orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $orders->with('user', 'address', 'retailer', 'details')->get()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'retailer_id' => 'required',
            'user_id' => 'required',
            'status_id' => 'required',
        ]);

        try {
            $order_data = json_decode($request->get('order_data'));
            $code = $request->get('code');
            $retailer_id = $request->get('retailer_id');
            $user_id = $request->get('user_id');
            $address_id = $request->get('address_id');
            $status_id = $request->get('status_id');
            // $delivery_time = $request->get('delivery_time');
            // $delivery_time = Carbon::createFromFormat('Y-m-d H:i', $delivery_time);
            $delivery_info = $request->get('delivery_info');
            $items_list = $request->get('items');
            $delivery_time = $request->get('delivery_time');
            $is_takeaway = $request->get('is_takeaway');
            $is_delivery = $request->get('is_delivery');
            $is_submitted = $request->get('is_submitted');

            $order = new Order();
            $order->code = $code;
            $order->retailer_id = $retailer_id;
            $order->user_id = $user_id;
            $order->address_id = $address_id;
            $order->status_id = $status_id;
            $order->delivery_time = $delivery_time;
            $order->is_takeaway = $is_takeaway;
            $order->delivery_info = json_encode($delivery_info);
            $order->is_delivery = $is_delivery;
            $order->is_submitted = true;

            $order->save();

            foreach ($items_list as $item) {
                $order->details()->attach($item['item']['id']);
            }

            foreach ($order->details as $detail) {
                foreach ($items_list as $item) {
                    if ($detail->id == $item['item']['id']) {
                        $detail->pivot->modify = [
                            "qty" => $item['qty']
                        ];
                        $detail->pivot->save();
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Order successfully created',
                'data' => $order->load('user', 'address', 'retailer', 'details')
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $order->load('user', 'address', 'retailer', 'details', 'status')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        try {
            $code = $request->get('code');
            $retailer_id = $request->get('retailer_id');
            $user_id = $request->get('user_id');
            $address_id = $request->get('address_id');
            $status_id = $request->get('status_id');
            $is_delivery = $request->get('is_delivery');
            $is_takeaway = $request->get('is_takeaway');
            // $delivery_time = $request->get('delivery_time');
            // $delivery_time = Carbon::createFromFormat('Y-m-d H:i', $delivery_time);
            $items_list = $request->get('items');
            $is_submitted = $request->get('is_submitted');
            $delivery_info = $request->get('delivery_info');


            $order->address_id = $address_id;
            $order->status_id = $status_id;
            $order->delivery_info = $delivery_info;
            $order->user_id = $user_id;
            $order->is_submitted = $request->get('is_submitted');
            $order->is_delivery = $is_delivery;
            $order->is_takeaway = $is_takeaway;
            // $order->delivery_time = $delivery_time;
            // TODO - items can be edited too
            $order->save();

            foreach ($items_list as $item) {
                $order->details()->attach($item['item']['id']);
            }

            foreach ($order->details as $detail) {
                foreach ($items_list as $item) {
                    if ($detail->id == $item['item']['id']) {
                        $detail->pivot->modify = [
                            "qty" => $item['qty']
                        ];
                        $detail->pivot->save();
                    }
                }
            }

            $order->user;
            $order->address;
            $order->retailer;
            $order->details;

            return response()->json([
                'success' => true,
                'message' => 'Order successfully edited',
                'data' => $order
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
            $order->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order successfully deleted',
                'data' => $order->with('user', 'address', 'retailer', 'details')->get()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function getListOfOrders(Retailer $retailer)
    {
        try {
            $orders_with_details = Retailer::with(['orders.user', 'orders.details', 'orders.address', 'orders.status', 'orders' => function ($query) {
                $query->where('is_submitted', true);
            }])->where('id', $retailer->id)->first();
            return response()->json([
                'success' => true,
                'message' => 'Here we are ciao',
                'data' => $orders_with_details
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function orderDetails(Retailer $retailer, Order $order)
    {
        try {
            return response()->json([
                'success' => true,
                'message' => 'Here we are ciao',
                'data' => Order::with(['user', 'address', 'retailer', 'details', 'status'])->where('id', $order->id)->first()
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function changeOrderStatus(Retailer $retailer, Order $order, Request $request)
    {
        $new_status = $request->get('updatedStatus');
        $order->status_id = $new_status;
        $order->save();
        return response()->json([
            'success' => true,
            'message' => 'status updated',
            'data' => $order->status
        ], 200);
    }

    public function cancelOrder(Order $order) {
        $order->status_id = 6;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order successfully cancelled',
            'data' => $order->load('status', 'details', 'retailer')
        ]);
    }

    public function getLastUnsubmittedOrder(Request $request)
    {
        $user_id = $request->get('user_id');
        $retailer_id = $request->get('retailer_id');

        try {
            $last_unsubmitted_order = Order::where(['user_id' => $user_id, 'retailer_id' => $retailer_id, 'is_submitted' => false])->orderBy('id', 'desc')->first();

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $last_unsubmitted_order
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getemv('MSG_ERROR'),
                'data' => $th->getMessage()
            ]);
        }
    }

    public function tempStore(Request $request)
    {
        $request->validate([
            'retailer_id' => 'required',
        ]);

        try {
            $retailer_id = $request->get('retailer_id');
            $user_id = $request->get('user_id');
            $code = $retailer_id . '-' . Str::random(5);

            $order = new Order();
            $order->code = $code;
            $order->retailer_id = $retailer_id;
            if ($user_id) {
                $order->user_id = $user_id;
            }
            $order->save();
            $order->retailer;
            if ($user_id) {
                $order->user;
            }

            return response()->json([
                'success' => true,
                'message' => 'Order successfully created',
                'data' => $order
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    // public function assignItem(Request $request, Order $order)
    // {
    //     $item_id = $request->get('item_id');
    //     try {
    //         $order->details()->attach($item_id);
    //         $order->save();

    //         return response()->json([
    //             'success' => true,
    //             'message' => getenv('MSG_SUCCESS'),
    //             'data' => $order
    //         ]);
    //     } catch (\Throwable $th) {
    //         return response()->json([
    //             'success' => true,
    //             'message' => getenv('MSG_ERROR'),
    //             'data' => $th->getMessage()
    //         ]);
    //     }
    // }

    public function notify(Order $order)
    {
        try {
            // return response()->json([
            //     'delivery_info'=>json_decode($order->delivery_info)
            // ]);
            $delivery_info = json_decode($order->delivery_info);

            $data = [
                'code' => $order->code,
                'retailer' => $order->retailer->name,
                'address' => $order->is_delivery || $delivery_info->is_ship ? ($order->address->address . ', ' . $order->address->city . ', ' . $order->address->zip_code . ', ' . $order->address->province) : '',
                'doorbell' => $order->is_delivery || $delivery_info->is_ship ? ($order->address->name) : '',
                'type' => $order->is_delivery ? 'Consegna a domicilio' : ($delivery_info->is_ship ? 'Spedizione' : 'Ritiro in negozio'),
                'date' => $delivery_info->date->day_name . ' ' . $delivery_info->date->day_number . ' ' . $delivery_info->date->month_name . ' ' . $delivery_info->date->year,
                'time' => $delivery_info->time->start . ' - ' . $delivery_info->time->end,
                'notes' => $delivery_info->notes,
                'phone' => $delivery_info->phone ? $delivery_info->phone : '',
                'payment_info' => $delivery_info->payment_info ? $delivery_info->payment_info : '',
                'items' => [],
                'delivery_charge' => $order->is_delivery ? $order->retailer->delivery_charge : '',
                'total' => 0,
                'is_ship'=>$delivery_info->is_ship,
                'ship_charge'=>$delivery_info->is_ship ? $delivery_info->ship_charge : '',
                'is_delivery'=>$order->is_delivery,
                'is_free'=>$delivery_info->is_free
            ];

            foreach ($order->details as $item) {
                $data['total'] += ($item->price) * (json_decode($item->pivot->modify)->qty);
                $data['items'][] = [
                    'name' => $item->name,
                    'sku' => $item->sku,
                    'qty' => json_decode($item->pivot->modify)->qty,
                    'price' => (($item->price) * (json_decode($item->pivot->modify)->qty) / 100)
                ];
            }

            if($data['is_ship']) {
                $data['total'] = $data['total'] + $data['ship_charge']*100;
                $data['ship_charge'] = ($data['ship_charge']);
            }

            if($data['delivery_charge']) {
                $data['total'] = $data['total'] + $data['delivery_charge'];
                $data['delivery_charge'] = ($data['delivery_charge'] / 100);
            }
            $data['total'] = ($data['total'] / 100);


            $to_retailer = json_decode($order->retailer->info)->email;
            $to_customer = $order->user->email;

            // $to_retailer = getenv('TEST_EMAIL_TO');
            // $to_customer = getenv('TEST_EMAIL_TO');

            Mail::to($to_retailer)->send(new OrderReceived($data));
            Mail::to($to_customer)->send(new OrderDispatched($data));

            return response()->json([
                'success' => true,
                'message' => "Mail successfully sent",
                'data' => [new OrderReceived($data), new OrderDispatched($data)]
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ]);
        }
    }

    public function submit(Order $order) {
        try {
            $order->is_submitted = true;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order submitted',
                'data' => $order
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getmessage()
            ]);
        }
    }
}
