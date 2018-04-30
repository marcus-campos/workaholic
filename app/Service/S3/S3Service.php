<?php
/**
 * User: marcus-campos
 * Date: 30/04/18
 * Time: 13:57
 */

namespace App\Service\S3;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class S3Service
{
    /**
     * @param $request
     * @param $directory
     * @return string
     */
    public function uploadFile($request, $directory)
    {
        $fileName = $directory . env('APP_ENV', 'local') . '-' . Str::orderedUuid() . '.' . $request->file->getClientOriginalExtension();
        $file = $request->file('file');
        $t = Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');

        return $fileName;
    }

    /**
     * @param $filePath
     * @return mixed
     */
    public function getFileUrl($filePath)
    {
        return  Storage::disk('s3')->url($filePath);
    }

    /**
     * @param $filePath
     */
    public function deleteFile($filePath)
    {
        Storage::disk('s3')->delete($filePath);
    }
}