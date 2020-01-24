<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function index2(){
        $title = 'Index 02';
        return view('pages.index02',compact('title', $title));
    }

    public function about(){
        $title = 'About';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $title = 'Services';
        return view('pages.services')->with('title',$title);
    }

    public function products(){
        $data = array(
            'title' => 'Products',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.products')->with($data);
    }

    public function contact(){
        $title = 'Contact Us!';
        return view ('pages.contact')->with('title',$title);
    }
}
