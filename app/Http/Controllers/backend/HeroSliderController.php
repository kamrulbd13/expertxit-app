<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    public function index(){
        return view('backend.heroSlider.index',[
            'heroSliderImages' => HeroSlider::orderBy('created_at', 'desc')->get(),
        ]);
    }

    //create
    public function create(){
        return view('backend.heroSlider.create');
    }
    //    store
    public function store(Request $request)
    {
        HeroSlider::saveData($request);
        return redirect()
            ->back()
            ->with('message','');
    }
//     detail
    public function details($id)
    {
        return view('backend.heroSlider.details',[
            'heroSliderImage'    => HeroSlider::find($id),
        ]);
    }
//     edit
    public function edit($id)
    {
        return view('backend.heroSlider.edit',[
            'heroSliderImage'    => HeroSlider::find($id),
        ]);
    }
    //     update
    public function update(Request $request, $id)
    {
        HeroSlider::updateData($request, $id);
        return redirect()
            ->route('home.hero.image.index')
            ->with('update','');
    }

//    delete
    public function delete($id)
    {
        HeroSlider::deleteData($id);
        return redirect()
            ->back()
            ->with('delete', '');
    }
}
