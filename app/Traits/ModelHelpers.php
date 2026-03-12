<?php

namespace App\Traits;

trait ModelHelpers
{
    public function matches(self $model): bool
    {
        return $this->id() === $model->id();
    }

    public function formatContentWithImages($body)
    {
        // Regex untuk mencari URL yang berakhiran ekstensi gambar (jpg, jpeg, png, gif, webp)
        $pattern = '/(https?:\/\/\S+\.(?:jpg|jpeg|png|gif|webp))/i';

        // Ganti URL tersebut dengan tag <img>
        $replacement = '<div class="my-4"><img src="$1" class="rounded-lg max-w-full h-auto" alt="User Image"></div>';

        return preg_replace($pattern, $replacement, $body);
    }
}
