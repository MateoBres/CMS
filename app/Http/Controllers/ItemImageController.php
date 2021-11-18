<?php

namespace App\Http\Controllers;
use App\Item;
use App\Retailer;
use App\ItemImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Image;
use DateTime;


class ItemImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $retailer, $item)
    {
        try 
        {
            $images = ItemImage::where('item_id', $item)
                                ->orderBy('id')
                                ->take(3)
                                ->get();
    
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $images
            ], 200);
        }
        catch (\Throwable $th) 
        {
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
    public function store(Request $request, $retailer, $item)
    {

        try {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
      
            $item_image = new ItemImage();
            
            $item_image->retailer_id = $retailer;
            $item_image->item_id = $item;
            
            
            if ($request->file('file')) {
                $file = $request->file('file');

                $imageName = $file->getClientOriginalName();
                $url_upload_items = '/public/item-gallery/'.$retailer.'/'.$item.'/';
                $store_file = $request->file('file')->storeAs($url_upload_items, $imageName);
                $path = public_path('/storage/item-gallery/'.$retailer.'/'.$item.'/'.$imageName);

                // thumbnail
                
                $date = new DateTime();
                $thumbnail_id = $date->getTimestamp();

                $url_upload_thumbnail = '/public/item-gallery/'.$retailer.'/'.$item.'/thumbnail/';
                $store_thumbnail = $request->file('file')->storeAs($url_upload_thumbnail, $thumbnail_id.'.jpg');
                $thumbnail_path = public_path('/storage/item-gallery/'.$retailer.'/'.$item.'/thumbnail/'.$thumbnail_id.'.jpg');
                $thumbnail = Image::make($thumbnail_path)->fit(500, 500)->save($thumbnail_path);
     
            }
            
            $item_image->file = '/storage/item-gallery/'.$retailer.'/'.$item.'/'.$imageName;
            $item_image->thumbnail = '/storage/item-gallery/'.$retailer.'/'.$item.'/thumbnail/'.$thumbnail_id.'.jpg';
            $item_image->save();
              
            return response()->json([
                'success' => true,
                'message' => getenv('MSG_SUCCESS'),
                'data' => $item_image
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $retailer, $item, $id)
    {
        try {

            $item_image = ItemImage::findOrFail($id);  
        
            $image_path = str_replace("/storage/", "public/", $item_image->file);
            $thumbnail_path = str_replace("/storage/", "public/", $item_image->thumbnail);
            //echo($image_path);

            Storage::delete($image_path);
            Storage::delete($thumbnail_path);
            $item_image->delete();

            return response()->json([
                'success' => true,
                'message' => 'Image successfully deleted',
                'data' => $item_image
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => getenv('MSG_ERROR'),
                'data' => $th->getMessage()
            ], 400);
        }
    }
}
