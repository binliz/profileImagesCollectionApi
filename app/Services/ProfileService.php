<?php


namespace App\Services;

use App\Profile;

class ProfileService
{
    public function store(string $name)
    {
        $profile = new Profile();
        $profile->name = $name;
        $profile->save();
        $imageService = new ImageService();
        $profile->images()->sync($imageService->notStoredImages());
        return $profile;
    }

    public function delete(Profile $profile)
    {
        $profile->images()->delete();
        $profile->delete();
    }
}
