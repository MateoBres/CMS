<?php

namespace App\Http\Controllers;
use App\Item;
use App\Retailer;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class RetailerController extends Controller
{
    /**
     * Display a listing of retailers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $retailers = Retailer::with(['address', 'items', 'categories', 'groups'])->where([
                ['info->phone', '<>', ""],
                ['info->email', '<>', ""],
                ['is_published', true]
            ])->orderBy('created_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $retailers
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
     * Display a listing of retailers based on the zip code.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_by_zip(String $zip)
    {
        try {
            $retailers = Retailer::whereJsonContains('info->zip_codes', $zip)->get();

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $retailers
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
     * Show the form for creating a new retailer.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    /**
     * Store a newly created retailer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'vat' => 'required|unique:retailers',
        ]);

        try {
            $info = $this->info_json();

            $retailer = new Retailer;
            $retailer->name = $request->input('name');
            $retailer->vat = $request->input('vat');
            $retailer->info = $info;
            $retailer->user_id = Auth::user()->id;
            $retailer->is_published = false;
            $retailer->slug = $this->slugify($request->input('name'));
            $retailer->url = '/azienda/' . $this->slugify($request->input('name')) . '/' . $request->input('vat');
            $retailer->qr_code = QrCode::generate(url('/') . $retailer->url);
            $retailer->save();

            // Storage::copy('/public/placeholders/logo.jpg', '/public/' . $retailer->vat . '/img/profile/logo.jpg');
            // Storage::copy('/public/placeholders/cover.jpg', '/public/' . $retailer->vat . '/img/profile/cover.jpg');

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $retailer
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
     * Display the specified retailer.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function show(Retailer $retailer)
    {
        try {
            $retailer->address;
            $retailer->items;
            foreach ($retailer->items as $item) {
                $item->tags;
            }

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $retailer->load('categories')
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 404);
        }
    }

    public function find_by_slug(Request $request, $slug)
    {
        try {
            $retailer = Retailer::where('slug', $slug)->first();

            return response()->json([
                'success' => true,
                'message' => getEnv('MSG_SUCCESS'),
                'data' => $retailer
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage(),
            ]);
        }

    }

    public function find_by_vat(Request $request, $vat)
    {
        try {
            $retailer = Retailer::where('vat', $vat)->first();

            return response()->json([
                'success' => true,
                'message' => getEnv('MSG_SUCCESS'),
                'data' => $retailer
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $th->getMessage(),
            ]);
        }

    }

    // Detail
    public function detail(Retailer $retailer, $slug, $vat)
    {
        try {
            //$myRetailer = Retailer::where('vat', $vat)->first();
            $myRetailer = $retailer->where('vat', $vat)->with('groups')->first();
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $myRetailer->load('categories', 'address', 'tags', 'items.tags')
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
     * Show the form for editing the specified retailer.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function edit(Retailer $retailer)
    {
        //
    }

    /**
     * Update the specified retailer in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer)
    {
        $name = ($request->get('name')) ? ($request->get('name')) : ($retailer->name);
        $vat = ($request->get('vat')) ? ($request->get('vat')) : ($retailer->vat);
        $alert_time = ($request->get('alert_time')) ? ($request->get('alert_time')) : ($retailer->alert_time);
        $delivery_time = ($request->get('delivery_time')) ? ($request->get('delivery_time')) : ($retailer->delivery_time);
        $delivery_charge = ($request->get('delivery_charge')) ? ($request->get('delivery_charge')) : ($retailer->delivery_charge);
        $does_delivery = $request->get('does_delivery') ? $request->get('does_delivery') : ($retailer->does_delivery);
        $does_takeaway = $request->get('does_takeaway') ? $request->get('does_takeaway') : ($retailer->does_takeaway);
        $info = $request->get('info');
        // if (!$does_takeaway && !$does_delivery) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Please select at least one option between delivery and takeaway',
        //         'data' => null
        //     ], 400);
        // }
        $decoded_info = json_decode($info);

        // if ($retailer->name && $decoded_info->email && $decoded_info->phone && $retailer->address) {
        //     $retailer->is_published = true;
        // }
        $retailer->is_published = $request->get('is_published') ? true : false;
        // return $request->get('is_published');
        try {
            $retailer->name = $name;
            $retailer->vat = $vat;
            $retailer->alert_time = $alert_time;
            $retailer->delivery_time = $delivery_time;
            $retailer->does_delivery = $does_delivery;
            $retailer->does_takeaway = $does_takeaway;
            $retailer->delivery_charge = $delivery_charge;
            $retailer->slug = $this->slugify($name);
            $retailer->info = $info;
            $retailer->save();

            return response()->json([
                'success' => true,
                'message' => 'Retailer information successfully updated',
                'data' => $retailer
            ], 200);
        } catch (\Throwable $th) {
            // throw $th;
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified retailer from storage.
     *
     * @param  \App\Retailer  $retailer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer)
    {
        try {
            $retailer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Retailer successfully deleted',
                'data' => $retailer
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
     * Create a JSON structure with empty values for the info field.
     *
     * @return string $info
     */
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

    public function add_category(Retailer $retailer, Request $request)
    {
        $shopCategories = $retailer->categories;
        try {
            if (count($shopCategories) < 3) {
                $category = $request->get('category');

                $retailer->categories()->attach($category['id']);
                return response()->json([
                    'success' => true,
                    'message' => 'Category successfully added',
                    'data' => $retailer
                ], 200);
            } else {
                return response()->json([
                    'success' => true,
                    'message' => 'Max limit exceeded',
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function get_list_of_category(Retailer $retailer)
    {
        try {
            $categories = $retailer->categories;
            return response()->json([
                'success' => true,
                'message' => 'ok',
                'data' => $categories
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    public function remove_category(Retailer $retailer, Category $category)
    {
        try {
            $retailer->categories()->detach($category->id);
            return response()->json([
                'success' => true,
                'message' => 'ok',
                'data' => $category
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 500);
        }
    }

    /** Retailer has Piva and slug */
    public function retailer_has_vat_slug(Retailer $retailer, $slug, $vat)
    {
         if ($retailer->items->contains($slug->slug && $vat->vat)) {
             return true;
         } else {
             return false;
         }
    }

    public function is_premium(Retailer $retailer) {
        return $retailer->premium;
    }

    public function get_slug(Retailer $retailer) {
        return response()->json([
            'success' => true,
            'message' => 'Data successfully retrieved',
            'data' => $retailer->slug
        ]);
    }
}
