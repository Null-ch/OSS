<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FileService
{
    public function uploadFile($file, $destinationPath)
    {
        DB::beginTransaction();
        try {
            $filename = time() . '_' . $file->getClientOriginalName();
            $this->createDirectoryIfNotExists(public_path($destinationPath));
            $file->move(public_path($destinationPath), $filename);
            DB::commit();
            return $filename;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function createDirectoryIfNotExists($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
    }
}
