<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousel = Carousel::all();
        return Inertia::render('Admin/Carousel/Index',[
            'carousel' => $carousel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Admin/Carousel/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required',
            'image' => 'mimes:png,jpg,jpeg'
        ]);

        $image_path = "";

        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('images/carousel', 'public');
        }

        $create = new Carousel();
        $create->tag = $request->input('tag');
        $create->image = $image_path;
        $create->save();

        return redirect()->route('carousel.index');
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
        $carousel = Carousel::find($id);
        return Inertia::render("Admin/Carousel/Edit", [
            'carousel' => $carousel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carousel $carousel)
    {
        $image_path = "";

        if ($request->hasFile('image')) {
            $this->validate($request, [
                'tag' => 'required',
                'image' => 'mimes:png,jpg,jpeg'
            ]);
            unlink(public_path('storage/'. $carousel->image));
            $image_path = $request->file('image')->store('images/carousel', 'public');
            $carousel->update([
                'tag' => $request->tag,
                'image' => $image_path
            ]);
        } else{
            $this->validate($request, [
                'tag' => 'required',
            ]);
            $carousel->update([
                'tag' => $request->tag,
            ]);
        }


        return redirect()->route('carousel.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carousel $carousel)
    {
        unlink(public_path('storage/'. $carousel->image));
        $carousel->delete();
        return redirect()->back();
    }
}
