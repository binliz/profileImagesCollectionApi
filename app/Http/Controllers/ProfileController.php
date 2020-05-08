<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileCollection;
use App\Profile;
use App\Services\ProfileService;
use \App\Http\Resources\Profile as ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profiles = Profile::with('images')->get();
        return response()->json(new ProfileCollection($profiles));
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
        $profileService = new ProfileService();
        $profile = $profileService->store(
            $request->post('name')
        );

        return response()->json(new ProfileResource($profile));

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
        return response()->json(new ProfileResource($profile));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
        $profile->name = $request->post('name');
        $profile->save();
        return response()->json(new ProfileResource($profile));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Profile $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
        $profileService = new ProfileService();
        $profileService->delete($profile);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function showimages(int $id)
    {
        //
        $profile = Profile::where('id', $id)->with('images')->first();
        return response()->json($profile->images);
    }

}
