<?php

namespace InetStudio\ContestsPackage\Contests\Http\Responses\Back\Utility;

use Illuminate\Http\Request;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Utility\SlugResponseContract;

/**
 * Class SlugResponse.
 */
class SlugResponse implements SlugResponseContract
{
    /**
     * @var string
     */
    protected $slug;

    /**
     * SlugResponse constructor.
     *
     * @param  string  $slug
     */
    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * Возвращаем slug по заголовку объекта.
     *
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->slug);
    }
}
