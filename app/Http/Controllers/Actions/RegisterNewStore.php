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
                    'name' => 'Lunedì',
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
                    'name' => 'Martedì',
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
                    'name' => 'Mercoledì',
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
                    'name' => 'Giovedì',
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
                    'name' => 'Venerdì',
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
            '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
            '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
            'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
            'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
            'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
            'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
            'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
            'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
            'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
            'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
            'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
            'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
            '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
            'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
            'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
            'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
            'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
            'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
            'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
            'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
            'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
            'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
            'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
            '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
            'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
            'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
            'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
            'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
            'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
            'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
            'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
            'ю' => 'yu', 'я' => 'ya'
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
