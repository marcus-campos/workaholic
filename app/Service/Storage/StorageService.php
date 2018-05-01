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

        Storage::disk(env('FILE_SYSTEM_DISK', 'public'))->put($fileName, file_get_contents($file), 'public');
        return $fileName;
    }

    /**
     * @param $filePath
     * @return mixed
     */
    public function getFileUrl($filePath)
    {
        return Storage::disk(env('FILE_SYSTEM_DISK', 'public'))->url($filePath);
    }

    /**
     * @param $filePath
     */
    public function deleteFile($filePath)
    {
        Storage::disk(env('FILE_SYSTEM_DISK', 'public'))->delete($filePath);
    }
}