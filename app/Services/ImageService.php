<?php


namespace App\Services;
use App\Image;
use App\Immagable;
use App\Profile;
use Illuminate\Http\UploadedFile;

class ImageService
{
    const STORAGE_PATH = 'public/image';
    const URL_PATH = '/storage/image';

    /**
     * @param UploadedFile $file
     * @param null|int $profileID
     * @return Image|null
     */
    public function store(UploadedFile $file,$profileID = null){
        if($file->isValid()){
            $path = $file->store($this::STORAGE_PATH);
            $urlPath = str_replace($this::STORAGE_PATH,$this::URL_PATH,$path);
            $image = new Image();
            $image->file_name = $path;
            $image->url = $urlPath;
            $image->save();
            if($profileID>0){
                Profile::find($profileID)->images()->attach($image);
            }
            return $image;
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function notStoredImages(){
        $imagesNotIn = Immagable::all()->pluck('id');
        $images = Image::whereNotIn('id',$imagesNotIn)->get();
        return $images;
    }
}
