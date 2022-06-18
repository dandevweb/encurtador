<?php

namespace App\Support;

use CoffeeCode\Optimizer\Optimizer;

class Seo {

    private $optimizer;

    public function __construct()
    {

        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
            env('APP_NAME'), 'pt_BR', 'article'
        )->publisher(
            env('CLIENT_SOCIAL_FACEBOOK_PAGE'),
            env('CLIENT_SOCIAL_FACEBOOK_AUTHOR')
        )->twitterCard(
            env('CLIENT_SOCIAL_TWITER_AUTHOR'),
            env('CLIENT_SOCIAL_TWITER_AUTHOR'),
            env('APP_URL'),
            "summary_large_image"
        );
    }

    public function render(
        string $title,
        string $description,
        string $url,
        string $image,
        bool $follow = true
    )
    {
        return $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }
}