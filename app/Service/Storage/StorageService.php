<?php
/**
 * User: marcus-campos
 * Date: 30/04/18
 * Time: 13:57
 */

namespace App\Service\Storage;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageService
{
    /**
     * @param $request
     * @param $directory
     * @return string
     */
    public function uploadFile($request, $directory)
    {
        $fileName = $directory . Str::orderedUuid() . '.' . $request->file->getClientOriginalExtension();
        $file = $request->file('file');

        if (env('APP_ENV', 'local') === 'local') {
            Storage::disk('public')->put($fileName, file_get_contents($file), 'public');
            return $fileName;
        }

        Storage::disk('s3')->put($fileName, file_get_contents($file), 'public');
        return $fileName;
    }

    /**
     * @param $filePath
     * @return mixed
     */
    public function getFileUrl($filePath)
    {
        if (env('APP_ENV', 'local') === 'local') {
            return Storage::disk('public')->url($filePath);
        }

        return Storage::disk('s3')->url($filePath);
    }

    /**
     * @param $filePath
     */
    public function deleteFile($filePath)
    {
        if (env('APP_ENV', 'local') === 'local') {
            Storage::disk('public')->delete($filePath);
        }

        Storage::disk('s3')->delete($filePath);
    }
}