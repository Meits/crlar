<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 08-Nov-18
 * Time: 10:43
 */

namespace App\Services;

use Image;

class ImageService
{

    /**
     * @param $image
     * @param $width
     * @param $height
     * @param $path
     * @return string
     */
    public static function handleUploadedImage($image,$width, $height, $path, $fileName=null)
    {

        if($image->isValid()) {
            if(!$fileName) {
                $fileName = str_random(10).'.'.$image->getClientOriginalExtension();
            }
            $img = Image::make($image);

            if($width && $height) {
                $img->fit(
                    $width,$height
                )->save($path.$fileName);
            }
            else {
                $img->save($path.$fileName);
            }

            return $fileName;
        }
        return '';
    }


    /**
     * @param $str
     * @param $path
     * @return string
     */
    public static function handleImageFromBase64($str, $path)
    {
        $file = str_random(15).'.png';
        $img = str_replace('data:image/png;base64,', '', $str);
        $img = str_replace(' ', '+', $img);
        $fileData = base64_decode($img);
        $url = $path.$file;
        file_put_contents($url, $fileData);

        return $file;
    }

    /**
     * @param $image
     * @param $path
     * @return string
     */
    public static function handleUploadedSvgImage($image, $path)
    {
        $fileName = str_random(10).'.'.$image->getClientOriginalExtension();
        $path = $image->move($path, $fileName);
        return $fileName;
    }

    /**
     * @param $image
     * @param $path
     * @return mixed
     */
    public static function handleUploadedAudio($image, $path)
    {
        $fileName = $image->getClientOriginalName();
        $path = $image->move($path, $fileName);
        return $fileName;
    }

    /**
     * @param $image
     * @param $path
     * @return string
     */
    public static function handleUploadedImageEditor($image, $path)
    {
        $fileName = str_random(10).'.'.$image->getClientOriginalExtension();
        $path = $image->move($path, $fileName);
        return $fileName;
    }
}