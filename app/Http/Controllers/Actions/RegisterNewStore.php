<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Retailer;
use App\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Validator;


class RegisterNewStore extends Controller
{
    public function __invoke(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required',
        //     'password_comfirmation' => 'required|same:password',
        // ]);

        // if ($validator->fails()) {
            
        // }

        $username = $request->get('username');
        $email = $request->get('email');
        $password = $request->get('password');
        $password_confirmation = $request->get('password_confirmation');
        $name = $request->get('name');
        $vat = $request->get('vat');

        if ($this->emailDuplicates($email)) {
            return response()->json([
                'success' => false,
                'message' => 'Email already exists',
                'data' => null
            ], 500);
        }

        if ($this->vatDuplicates($vat)) {
            return response()->json([
                'success' => false,
                'message' => 'VAT already exists',
                'data' => null
            ], 500);
        }

        $user = $this->createUser([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $token = $user->createToken('MyApp')->accessToken;

        $retailer = $this->createRetailer([
            'name' => $name,
            'vat' => $vat,
        ], $user);

        return response()->json([
            'success' => true,
            'message' => 'Retailer successfully registered',
            'data' => [
                'user' => $user,
                'retailer' => $retailer,
                'token' => $token,
            ],
        ], 200);
    }

    public function emailDuplicates(String $email)
    {
        if (User::where('email', $email)->count() > 0) {
            return true;
        } return false;
    }

    public function vatDuplicates(String $vat)
    {
        if (Retailer::where('vat', $vat)->count() > 0) {
            return true;
        } return false;
    }

    public function createUser(Array $params)
    {
        $user = User::create([
            'name' => $params['name'],
            'email' => $params['email'],
            'password' => $params['password'],
        ]);

        $user->assignRole('publisher');
        return $user;
    }

    public function createRetailer(Array $params, User $user)
    {
        $info = $this->info_json();

        $retailer = new Retailer;
        $retailer->name = $params['name'];
        $retailer->vat = $params['vat'];
        $retailer->user_id = $user->id;
        $retailer->is_published = false;
        $retailer->slug = $this->slugify($params['name']);
        $retailer->url = '/azienda/' . $retailer->slug . '/' . $params['vat'];
        $retailer->qr_code = QrCode::generate(url('/') . $retailer->url);
        $retailer->save();

        return $retailer;
    }

    public function info_json()
    {
        $info = [
            'description' => "",
            'phone' => '',
            'email' => '',
            'zip_codes' => [],
            'min_order' => '',
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
                'lng' => ''
            ],
            'payments' => [
                'cash' => [
                    'checked' => true
                ],
                'card' => [
                    'checked' => false,
                    'stripe_key' => '',
                ],
                'transfer' => [
                    'checked' => false,
                    'iban_code' => '',
                    'name' => '',
                    'number' => '',
                ],
            ],
            'timeslots' => [
                [
                    'id' => 1,
                    'name' => 'Luned??',
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    'name' => 'Marted??',
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    'name' => 'Mercoled??',
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    'name' => 'Gioved??',
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    'name' => 'Venerd??',
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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
                    "opening_schedule" => "",
                    "delivery_schedule" => "",
                    "takeaway_schedule" => "",
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

    public static function slugify($text)
    {

        $replace = [
            '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
            '&quot;' => '', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'Ae',
            '&Auml;' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'A', '??' => 'Ae',
            '??' => 'C', '??' => 'C', '??' => 'C', '??' => 'C', '??' => 'C', '??' => 'D', '??' => 'D',
            '??' => 'D', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E',
            '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'E', '??' => 'G', '??' => 'G',
            '??' => 'G', '??' => 'G', '??' => 'H', '??' => 'H', '??' => 'I', '??' => 'I',
            '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I', '??' => 'I',
            '??' => 'I', '??' => 'IJ', '??' => 'J', '??' => 'K', '??' => 'K', '??' => 'K',
            '??' => 'K', '??' => 'K', '??' => 'K', '??' => 'N', '??' => 'N', '??' => 'N',
            '??' => 'N', '??' => 'N', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
            '??' => 'Oe', '&Ouml;' => 'Oe', '??' => 'O', '??' => 'O', '??' => 'O', '??' => 'O',
            '??' => 'OE', '??' => 'R', '??' => 'R', '??' => 'R', '??' => 'S', '??' => 'S',
            '??' => 'S', '??' => 'S', '??' => 'S', '??' => 'T', '??' => 'T', '??' => 'T',
            '??' => 'T', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'Ue', '??' => 'U',
            '&Uuml;' => 'Ue', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U', '??' => 'U',
            '??' => 'W', '??' => 'Y', '??' => 'Y', '??' => 'Y', '??' => 'Z', '??' => 'Z',
            '??' => 'Z', '??' => 'T', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a',
            '??' => 'ae', '&auml;' => 'ae', '??' => 'a', '??' => 'a', '??' => 'a', '??' => 'a',
            '??' => 'ae', '??' => 'c', '??' => 'c', '??' => 'c', '??' => 'c', '??' => 'c',
            '??' => 'd', '??' => 'd', '??' => 'd', '??' => 'e', '??' => 'e', '??' => 'e',
            '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e', '??' => 'e',
            '??' => 'f', '??' => 'g', '??' => 'g', '??' => 'g', '??' => 'g', '??' => 'h',
            '??' => 'h', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i',
            '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'i', '??' => 'ij', '??' => 'j',
            '??' => 'k', '??' => 'k', '??' => 'l', '??' => 'l', '??' => 'l', '??' => 'l',
            '??' => 'l', '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'n', '??' => 'n',
            '??' => 'n', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'oe',
            '&ouml;' => 'oe', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'o', '??' => 'oe',
            '??' => 'r', '??' => 'r', '??' => 'r', '??' => 's', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'ue', '??' => 'u', '&uuml;' => 'ue', '??' => 'u', '??' => 'u',
            '??' => 'u', '??' => 'u', '??' => 'u', '??' => 'w', '??' => 'y', '??' => 'y',
            '??' => 'y', '??' => 'z', '??' => 'z', '??' => 'z', '??' => 't', '??' => 'ss',
            '??' => 'ss', '????' => 'iy', '??' => 'A', '??' => 'B', '??' => 'V', '??' => 'G',
            '??' => 'D', '??' => 'E', '??' => 'YO', '??' => 'ZH', '??' => 'Z', '??' => 'I',
            '??' => 'Y', '??' => 'K', '??' => 'L', '??' => 'M', '??' => 'N', '??' => 'O',
            '??' => 'P', '??' => 'R', '??' => 'S', '??' => 'T', '??' => 'U', '??' => 'F',
            '??' => 'H', '??' => 'C', '??' => 'CH', '??' => 'SH', '??' => 'SCH', '??' => '',
            '??' => 'Y', '??' => '', '??' => 'E', '??' => 'YU', '??' => 'YA', '??' => 'a',
            '??' => 'b', '??' => 'v', '??' => 'g', '??' => 'd', '??' => 'e', '??' => 'yo',
            '??' => 'zh', '??' => 'z', '??' => 'i', '??' => 'y', '??' => 'k', '??' => 'l',
            '??' => 'm', '??' => 'n', '??' => 'o', '??' => 'p', '??' => 'r', '??' => 's',
            '??' => 't', '??' => 'u', '??' => 'f', '??' => 'h', '??' => 'c', '??' => 'ch',
            '??' => 'sh', '??' => 'sch', '??' => '', '??' => 'y', '??' => '', '??' => 'e',
            '??' => 'yu', '??' => 'ya'
        ];

        // make a human readable string
        $text = strtr($text, $replace);

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // remove unwanted characters
        $text = preg_replace('~[^-\w.]+~', '', $text);

        $text = strtolower($text);

        return $text;
    }
}
