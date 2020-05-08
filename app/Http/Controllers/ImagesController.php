<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImageCollection;
use App\Image;
use App\Services\ImageService;
use App\Http\Resources\Image as ImageResource;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $images = new ImageService();

        return response()->json(new ImageCollection($images->notStoredImages()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $images = new ImageService();
        $image = $images->store($request->file('image'), $request->post('profile_id'));
        return response()->json(new ImageResource($image));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Image::destroy($id);
    }
}
