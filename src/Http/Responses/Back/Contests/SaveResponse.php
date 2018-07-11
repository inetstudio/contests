<?php

namespace InetStudio\Contests\Http\Responses\Back\Contests;

use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Responsable;
use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\SaveResponseContract;

/**
 * Class SaveResponse.
 */
class SaveResponse implements SaveResponseContract, Responsable
{
    /**
     * @var ContestModelContract
     */
    private $item;

    /**
     * SaveResponse constructor.
     *
     * @param ContestModelContract $item
     */
    public function __construct(ContestModelContract $item)
    {
        $this->item = $item;
    }

    /**
     * Возвращаем ответ при сохранении объекта.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return RedirectResponse
     */
    public function toResponse($request): RedirectResponse
    {
        return response()->redirectToRoute('back.contests.edit', [
            $this->item->fresh()->id,
        ]);
    }
}
