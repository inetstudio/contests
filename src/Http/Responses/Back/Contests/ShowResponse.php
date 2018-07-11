<?php

namespace InetStudio\Contests\Http\Responses\Back\Contests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract, Responsable
{
    /**
     * @var ContestModelContract
     */
    private $item;

    /**
     * ShowResponse constructor.
     *
     * @param ContestModelContract $item
     */
    public function __construct(ContestModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return JsonResponse
     */
    public function toResponse($request): JsonResponse
    {
        return response()->json($this->item);
    }
}
