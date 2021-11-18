<?php

namespace App\Http\Controllers;

use App\Item;
use App\Retailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Retailer $retailer)
    {
        try {
            $items = $retailer->items()->orderBy('name', 'asc')->get();
            $items_full_data = [];
            foreach ($items as $item) {
                $tags = $item->tags;
                $item->tags = $tags;
                array_push($items_full_data, $item);
            }

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $items_full_data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 400);
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
    public function store(Request $request, Retailer $retailer)
    {
        $request->validate([
            'name' => 'required|max:125',
            'desc' => 'required|max:240',
            'price' => 'required|numeric',
            'sku' => 'required'
        ]);

        if (!$this->user_has_retailer($retailer)) {
            dump($retailer);
            return response()->json([
                'success' => false,
                'message' => "You don't own this retailer, unable to proceed",
                'data' => null
            ], 400);
        }

        try {
            $name = $request->get('name');
            $description = $request->get('desc');
            $long_description = $request->get('long_description');
            $price = $request->get('price');
            $sku = $request->get('sku');
            $tags = $request->get('tags');
            $info = $request->get('info');
            $variation = $request->get('variation');


            $item = new Item();
            $item->name = $name;
            $item->description = $description;
            $item->long_description = $long_description;
            $item->price = $price;
            $item->sku = $sku;
            $item->retailer_id = $retailer->id;
            $item->info = $info;
            $item->variation = $variation;
            $item->save();

            if( $tags ) {
                foreach ($tags as $tag) {
                    $item->tags()->attach($tag);
                }
            }

            return response()->json([
                'name' => 'success',
                'message' => 'Item successfully created',
                'data' => $item
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
     * @param  \App\Retailer  $retailer
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Retailer $retailer, Item $item)
    {
        try {
            if (!$this->retailer_has_item($retailer, $item)) {
                return response()->json([
                    'success' => false,
                    'message' => "Access to the resource denied; This retailer does not own the requested item",
                    'data' => null
                ], 400);
            }

            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => Item::with('tags', 'images')->find($item->id)
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Retailer  $retailer
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Retailer $retailer, Item $item)
    {
        try {
            if (!$this->retailer_has_item($retailer, $item)) {
                return response()->json([
                    'success' => false,
                    'message' => "Access to the resource denied; This retailer does not own the requested item",
                    'data' => null
                ], 400);
            }

            $vat = $retailer->vat;
            $sku = $item->sku;
            $path = '/' . $vat . '/img/items' . $sku;
            $name = $request->input('name');
            $description = $request->input('description');
            $price = $request->input('price');
            $long_description = $request->input('long_description');
            $tags = $request->input('tags');
            $info = $request->input('info');
            $variation = $request->input('variation');
            //$image = $request->file('image')->storeAs($path, 'featured.jpg');;
            //$image = $request->file('image')->store('data');
            //$temp = Storage::putFile('avatars', $request->file('avatar'));
            $item->name = $name;
            $item->description = $description;
            $item->price = $price;
            $item->long_description = $long_description;
            $item->info = $info;
            $item->variation = $variation;
            $item->save();

            $item->tags()->detach();

            foreach ($tags as $tag) {
                $item->tags()->attach($tag);
            }

            return response()->json([
                'success' => true,
                'message' => 'Item successfully edited',
                'data' => $item
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Retailer  $retailer
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Retailer $retailer, Item $item)
    {
        try {
            if (!$this->retailer_has_item($retailer, $item)) {
                return response()->json([
                    'success' => false,
                    'message' => "Access to the resource denied; This retailer does not own the requested item",
                    'data' => null
                ], 400);
            }
            $item_path = '/storage/app/public/' . $retailer->vat . '/img/items/' . $item->sku;
            Storage::deleteDirectory($item_path);
            $item->delete();

            return response()->json([
                'success' => true,
                'message' => 'Item successfully deleted',
                'data' => $item
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
     * Check whether the authenticated User is associated with the specified Retailer.
     *
     * @param  \App\Retailer  $retailer
     * @return boolean
     */
    public function user_has_retailer(Retailer $retailer)
    {
        $user = Auth::user();
        if ($user->retailers->contains($retailer->id)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check whether the specified Retailer is associated with the specified Item.
     *
     * @param  \App\Retailer  $retailer
     * @param  \App\Item  $item
     * @return boolean
     */
    public function retailer_has_item(Retailer $retailer, Item $item)
    {
        if ($retailer->items->contains($item->id)) {
            return true;
        } else {
            return false;
        }
    }
}
