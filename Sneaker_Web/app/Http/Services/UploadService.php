<?php

namespace App\Http\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadService 
{
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                $file = $request->file('file');
                $name = $file->getClientOriginalName();
                $pathFull = 'uploads/' . date('Y/m/d');

                // Tạo đối tượng Image từ file đã tải lên
                $image = Image::make($file);

                // Thay đổi kích thước ảnh (ví dụ: resize về 800x600 và giữ tỷ lệ)
                $image->resize(319, 390, function ($constraint) {
                    $constraint->aspectRatio();
                });

                // Lưu ảnh đã thay đổi kích thước vào storage
                Storage::put('public/' . $pathFull . '/' . $name, (string) $image->encode());

                return '/storage/' . $pathFull . '/' . $name;

            } catch (\Exception $e) {
                return false;
            }
        }

        return false;
    }
}
