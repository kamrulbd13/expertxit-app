<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Ebook;
use App\Models\HeroSlider;
use App\Models\Trainer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //index
    public function index()
    {
        return view('frontend.home.index',[
            'teamTrainers' => Trainer::where('status', 1)->get(),
            'heroSliders' => HeroSlider::where('status', 1)->get(),
        ]);
    }
    //contact
    public function contact()
    {
        return view('frontend.contact.index');
    }
    //ebook
    public function ebook()
    {
        return view('frontend.ebook.index',[
            'ebooks' => Ebook::where('status',1)->get(),
        ]);
    }

//details
    public function details($id)
    {
        $ebook = Ebook::findOrFail($id);
        return view('frontend.ebook.details', compact('ebook'));
    }

public function about(){
        return view('frontend.about.index');
}
public function privacyPolicy(){
        return view('frontend.privacyPolicy.index');
}

public function termsService(){
        return view('frontend.termsService.index');

}

public function accessibility(){
        return view('frontend.accessibility.index');
}

public function sitemap(){
        return view('frontend.sitemap.index');
}








}
