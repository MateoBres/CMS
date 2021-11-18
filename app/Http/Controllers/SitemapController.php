<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Retailer;

class SitemapController extends Controller
{
    
    public function index()
    {
      $retailers = Retailer::All();
      //$podcast = Podcast::active()->orderBy('updated_at', 'desc')->first();
    
      return response()->view('sitemap', [
          'retailers' => $retailers,
          //'podcast' => $podcast,
      ])->header('Content-Type', 'text/xml');
    }

}
