<?php

namespace Mi\MiImageUtility;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Spatie\Glide\GlideImage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MiImageUtility
{
    /***
     * @param $file
     * @param array $modificationParameters
     * @return JsonResponse|BinaryFileResponse
     */
    public static function createImage($file, array $modificationParameters): BinaryFileResponse|JsonResponse
    {

        $info = pathinfo($file);
        $img = $info['basename'];
        $i = explode('.', $img);

        if (!$img || !is_string($file)) {
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
            $cacheImage = $image_name . '-' . (($width) ? $width : 0) . 'x' . (($height) ? $height : 0) . $fit . $quality . $bg;
            $cacheImage = $cacheImage . '.' . $ext;

            $newImage = self::checkFolderAvailability($file,$cacheImage);

            if (file_exists(storage_path($newImage))) {
                return new BinaryFileResponse(storage_path($newImage), 200);
            } else {
                $files = storage_path('images/' . $info['basename']);

                try {
                    $contents = file_get_contents($file);
                    file_put_contents($files, $contents);
                }catch (Exception $e){
                    return response()->json(["data" => "Invalid Image"], Response::HTTP_NOT_FOUND);
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

    /***
     * @param $file
     * @param $cacheImage
     * @return string
     */
    private static function checkFolderAvailability($file, $cacheImage): string
    {
        $path = parse_url($file, PHP_URL_PATH);
        $items = array_filter(explode('/', $path),fn($val) => $val);
        $folder = "";
        $newImage = 'images/cache/' . $cacheImage;
        if (count($items) > 2) {
            $folder = $items[count($items) - 2];
            $newImage = 'images/cache/' . $folder . '/' . $cacheImage;
        }

        $imageFolder = 'images/cache/' . $folder;
        if (!is_dir(storage_path($imageFolder))) {
            mkdir(storage_path($imageFolder), 0777, true);
            chmod(storage_path($imageFolder), 0777);
        }
        return $newImage;
    }
}
