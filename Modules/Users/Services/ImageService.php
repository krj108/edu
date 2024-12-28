<?php

namespace Modules\Users\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService {
    /**
     * Store or update an avatar image.
     *
     * @param UploadedFile|null $file
     * @param string|null $existingPath
     * @return string|null
     */
    public function storeAvatar(?UploadedFile $file, ?string $existingPath = null): ?string {
        if ($file) {
            // Delete existing image if provided
            if ($existingPath) {
                Storage::disk('public')->delete($existingPath);
            }
            // Store the new image and return its path
            return $file->store('avatars', 'public');
        }
        return $existingPath;
    }
}
