<?php

namespace App\Restify;

use App\Models\Post;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use App\Restify\Repository;


class PostRepository extends Repository
{
    public static string $model = Post::class;

    public function fields(RestifyRequest $request): array
    {
        return [
            id(),
            field('name')->required(),
            field('body')->required(),
            field('created_at')->datetime()->nullable()->readonly(),
            field('updated_at')->datetime()->nullable()->readonly(),
        ];
    }
}
