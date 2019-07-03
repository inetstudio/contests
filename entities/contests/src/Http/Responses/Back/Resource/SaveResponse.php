<?php

namespace InetStudio\ContestsPackage\Contests\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract
{
    /**
     * @var ContestModelContract
     */
    protected $item;

    /**
     * SaveResponse constructor.
     *
     * @param  ContestModelContract  $item
     */
    public function __construct(ContestModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param  Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $item = $this->item->fresh();

        return response()->redirectToRoute(
            'back.contests.edit',
            [
                $item['id'],
            ]
        );
    }
}
