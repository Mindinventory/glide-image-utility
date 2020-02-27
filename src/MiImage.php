<?php

namespace Mi\MiImageUtility;

use Illuminate\Http\Response;
use Spatie\Glide\GlideImage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MiImage
{
    public static function createImage($file, array $modificationParameters)
    {
        $info = pathinfo($file);
        $img = $info['basename'];
        $i = explode('.', $img);

        if (!$img) {
            return response()->json(["data" => "Invalid Image"], Response::HTTP_NOT_FOUND);
        } else if ($i[count($i) - 1] == 'jpg' || $i[count($i) - 1] == 'png' || $i[count($i) - 1] == 'jpeg') {

            $width = '';
            if (isset($modificationParameters['w'])) {
                $width = $modificationParameters['w'];
            }
            $height = '';
            if (isset($modificationParameters['h'])) {
                $height = $modificationParameters['h'];
            }
            $fit = '';
            if (isset($modificationParameters['fit']) && in_array($modificationParameters['fit'], ['contain', 'max', 'fill', 'stretch', 'crop'])) {
                $fit = $modificationParameters['fit'];
            }
            $quality = '';
            if (isset($modificationParameters['q']) && $modificationParameters['q'] <= 100 && $modificationParameters['q'] > 0) {
                $quality = (int)$modificationParameters['q'];
            }
            $format = '';
            if (isset($modificationParameters['fm']) && in_array($modificationParameters['fm'], ['jpg', 'pjpg', 'png', 'gif', 'webp'])) {
                $format = $modificationParameters['fm'];
            }
            $bg = '';
            if (isset($modificationParameters['bg'])) {
                $bg = $modificationParameters['bg'];
            }

            $tmpImageArr = (explode('.', $img));
            $ext = end($tmpImageArr);
            $image_name = basename($img, '.' . $ext);
            $cacheImage = $image_name . '-' . (($width) ? $width : 0) . 'x' . (($height) ? $height : 0) . $fit . $quality;
            $cacheImage = $cacheImage . '.' . $ext;

            $items = explode('/', $file);
            if (sizeof($items) > 1) {
                $folder = $items[sizeof($items) - 2];
                $newImage = 'images/cache/' . $folder . '/' . $cacheImage;
            } else {
                $folder = "";
                $newImage = 'images/cache/' . $cacheImage;
            }


            if (file_exists(storage_path($newImage))) {
                return new BinaryFileResponse(storage_path($newImage), 200);
            } else {

                $contents = file_get_contents(storage_path('images/'.$file));
                $image = storage_path('images');
                if (!is_dir($image)) {
                    mkdir($image, 0777, true);
                    chmod($image, 0777);
                }

                $file = storage_path('images/' . $info['basename']);
                file_put_contents($file, $contents);
                chmod($file, 0777);

                $imageFolder = storage_path('images/cache/' . $folder);
                if (!is_dir($imageFolder)) {
                    mkdir($imageFolder, 0777, true);
                    chmod($imageFolder, 0777);
                }

                $pathToImage = storage_path('images/' . $img);

                GlideImage::create($pathToImage)
                    ->modify(['w' => $width, 'h' => $height, 'fit' => $fit, 'q' => $quality, 'fm' => $format, 'bg' => $bg])
                    ->save(storage_path($newImage));
                chmod(storage_path($newImage), 0777);
                unlink($pathToImage);

                return new BinaryFileResponse(storage_path($newImage), 200);
            }
        } else {
            return response()->json(["data" => "Invalid Image"], Response::HTTP_NOT_FOUND);
        }
    }
}
