<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use App\Retailer;
use App\User;
use App\Mail\ContactsForm;
use App\Mail\OrderDispatched;
use App\Mail\OrderReceived;
use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Image;
use PDF;

class UtilityController extends Controller
{
    public function image_upload(Request $request)
    {
        $retailer_vat = $request->get('retailer_vat');
        $item_sku = ($request->get('sku')) ? ($request->get('sku')) : '';
        $url_upload_profile = '/public/' . $retailer_vat . '/img/profile';
        $url_upload_items = '/public/' . $retailer_vat . '/img/items/' . $item_sku;
        try {
            $logo_path = '';
            $cover_path = '';
            $item_path = '';
            $thumbnail_path = '';

            if ($request->file('logo')) {
                $logo = $request->file('logo')->storeAs($url_upload_profile, 'logo.jpg');
                $logo_path = public_path('/storage/' . $retailer_vat . '/img/profile/logo.jpg');
                $img = Image::make($logo_path)->fit(500, 500)->save($logo_path);
            }

            if ($request->file('cover')) {
                $cover = $request->file('cover')->storeAs($url_upload_profile, 'cover.jpg');
                $cover_path = public_path('/storage/' . $retailer_vat . '/img/profile/cover.jpg');
                $img = Image::make($cover_path)->fit(1280, 800)->save($cover_path);
            }

            if ($request->file('item_image')) {
                $item = $request->file('item_image')->storeAs($url_upload_items, 'featured.jpg');
                $item_thumb = $request->file('item_image')->storeAs($url_upload_items, 'thumbnail.jpg');


                $item_path = public_path('/storage/' . $retailer_vat . '/img/items/' . $item_sku . '/featured.jpg');
                $thumbnail_path = public_path('/storage/' . $retailer_vat . '/img/items/' . $item_sku . '/thumbnail.jpg');

                $img = Image::make($item_path)->fit(1280, 800)->save($item_path);
                $img_thumb = Image::make($thumbnail_path)->fit(300, 300)->save($thumbnail_path);
            }

            $data = [
                'logo' => $logo_path ? $logo_path : '',
                'cover' => $cover_path ? $cover_path : '',
                'item'  => $item_path ? $item_path : '',
                'item'  => $thumbnail_path ? $thumbnail_path : '',
            ];

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ]);
        }
    }

    public function delete_open_orders()
    {
        $deleted = 0;
        $orders = Order::where('user_id', null)->get();
        foreach ($orders as $order) {
            $order->delete();
            $deleted++;
        }

        return response()->json([
            'success' => true,
            'message' => 'Orders Deleted',
            'data' => $deleted
        ], 200);
    }

    public function send_mail(Request $request)
    {
        $notification_type = $request->get('notification_type');
        $to = $request->get('to');
        $data = $request->get('data');

        switch ($notification_type) {
            case getenv('NOTIFY_SENT'):
                Mail::to($to)->send(new OrderDispatched($data));
                break;

            case getenv('NOTIFY_RECEIVED'):
                Mail::to($to)->send(new OrderReceived($data));
                break;

            case getenv('NOTIFY_CONTACTS'):
                Mail::to($to)->send(new ContactsForm($data));
                break;

            case getenv('PASSWORD_RESET'):
                Mail::to($to)->send(new PasswordReset($data));

            default:
                break;
        }
    }

    public function preview_mail(Request $request)
    {
        $notification_type = $request->get('notification_type');
        $to = $request->get('to');
        $data = $request->get('data');

        switch ($notification_type) {
            case getenv('NOTIFY_SENT'):
                return new OrderDispatched($data);
                break;

            case getenv('NOTIFY_RECEIVED'):
                return new OrderReceived($data);
                break;

            case getenv('NOTIFY_CONTACTS'):
                return new ContactsDorm($data);
                break;

            default:
                break;
        }
    }

    public function contacts(Request $request)
    {
        $data = $request->get('data');

        // return response()->json([
        //     'data' => $data
        // ]);

        // Mail::to(getenv('TEST_EMAIL_TO'))->send(new ContactsForm($data));
        try {
            Mail::to(getenv('MAIL_TO'))->send(new ContactsForm($data));
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function check_repeated(Request $request) {
        $vat = $request->get('vat') ? $request->get('vat') : null;
        $mail = $request->get('mail');

        $mail_check = User::where('email', $mail)->first();
        if($mail_check) {
            return response()->json([
                'success' => false,
                'message' => "L'indirizzo email inserito è già stato utilizzato",
                'data' => $mail
            ]);
        } else {
            if($vat) {
                $vat_check = Retailer::where('vat', $vat)->first();

                if($vat_check) {
                    return response()->json([
                        'success' => false,
                        'message' => "La partita IVA inserita è già stato utilizzata",
                        'data' => $vat
                    ]);
                } else {
                    return response()->json([
                        'success' => true,
                        'message' => "No dati ripetuti",
                        'data' => [$vat, $mail]
                    ]);
                }
            } else {
                return response()->json([
                    'success' => true,
                    'message' => "No dati ripetuti",
                    'data' => $mail
                ]);
            }
        }
    }

    public function pdf(Order $order) {
        $data = [
            'code' => $order->code,
            'retailer' => $order->retailer->name,
            'address' => $order->is_delivery ? ($order->address->address . ', ' . $order->address->city . ', ' . $order->address->zip_code . ', ' . $order->address->province) : '',
            'doorbell' => $order->is_delivery ? ($order->address->name) : '',
            'type' => $order->is_delivery ? 'Consegna a domicilio' : 'Ritiro in negozio',
            'date' => json_decode($order->delivery_info)->date->day_name . ' ' . json_decode($order->delivery_info)->date->day_number . ' ' . json_decode($order->delivery_info)->date->month_name . ' ' . json_decode($order->delivery_info)->date->year,
            'time' => json_decode($order->delivery_info)->time->start . ' - ' . json_decode($order->delivery_info)->time->end,
            'notes' => '',
            'phone' => json_decode($order->delivery_info)->phone ? json_decode($order->delivery_info)->phone : '',
            'items' => [],
            'total' => 0,
            'is_delivery' => $order->is_delivery,
            'delivery_charge' => intval(json_decode($order->delivery_info)->delivery_charge),
            'status' => $order->status->name,
            'info' => json_decode($order->delivery_info)
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


        $data['total'] = ($data['total'] / 100);

        if ($order->is_delivery) {
            $data['total'] += $data['delivery_charge'];
        }


        // $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('layouts.PDF.order', ['data'=>$data]);
        return $pdf->stream();
    }

    public function pdfRetailer(Order $order) {
        $data = [
            'code' => $order->code,
            'retailer' => $order->retailer->name,
            'address' => $order->is_delivery || json_decode($order->delivery_info)->is_ship ? ($order->address->address . ', ' . $order->address->city . ', ' . $order->address->zip_code . ', ' . $order->address->province) : '',
            'doorbell' => $order->is_delivery || json_decode($order->delivery_info)->is_ship ? ($order->address->name) : '',
            'type' => $order->is_delivery ? 'Consegna a domicilio' : (json_decode($order->delivery_info)->is_ship ? 'Spedizione' : 'Ritiro in negozio'),
            'date' => json_decode($order->delivery_info)->date->day_name . ' ' . json_decode($order->delivery_info)->date->day_number . ' ' . json_decode($order->delivery_info)->date->month_name . ' ' . json_decode($order->delivery_info)->date->year,
            'time' => json_decode($order->delivery_info)->time->start . ' - ' . json_decode($order->delivery_info)->time->end,
            'notes' => json_decode($order->delivery_info)->notes ? json_decode($order->delivery_info)->notes : '',
            'phone' => json_decode($order->delivery_info)->phone ? json_decode($order->delivery_info)->phone : '',
            'items' => [],
            'total' => 0,
            'is_delivery' => $order->is_delivery,
            'delivery_charge' => intval(json_decode($order->delivery_info)->delivery_charge),
            'status' => $order->status->name,
            'notes' => json_decode($order->delivery_info)->notes,
            'email' => $order->user->email,
            'username' => $order->user->name,
            'is_ship' => json_decode($order->delivery_info)->is_ship,
            'ship_charge' => json_decode($order->delivery_info)->ship_charge,
            'is_free' => json_decode($order->delivery_info)->is_free,
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

        $data['total'] = ($data['total'] / 100);

        if ($order->is_delivery == true) {
            $data['total'] += $data['delivery_charge'];
        } elseif ($data['is_ship'] && !$data['is_free']) {
            $data['total'] += $data['ship_charge'];
        }


        // $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('layouts.PDF.retailer-order', ['data'=>$data]);
        return $pdf->stream();
    }

    public function randomString() {
        $string = Str::random(5);

        return response()->json([
            'success' => true,
            'message' => 'String successfully generated',
            'data' => $string
        ]);
    }
}
