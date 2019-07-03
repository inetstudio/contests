<?php

namespace InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

/**
 * Class ShowResponse.
 */
class ShowResponse implements ShowResponseContract
{
    /**
     * @var ContestModelContract
     */
    protected $item;

    /**
     * ShowResponse constructor.
     *
     * @param  ContestModelContract  $item
     */
    public function __construct(ContestModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при получении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return response()->json($this->item);
    }
}
