<?php

namespace InetStudio\Contests\Services\Back;

use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Services\Back\ContestsObserverServiceContract;

/**
 * Class ContestsObserverService.
 */
class ContestsObserverService implements ContestsObserverServiceContract
{
    /**
     * @var
     */
    public $repository;

    /**
     * ContestsObserverService constructor.
     */
    public function __construct()
    {
        $this->repository = app()->make('InetStudio\Contests\Contracts\Repositories\ContestsRepositoryContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param ContestModelContract $item
     */
    public function creating(ContestModelContract $item): void
    {
    }

    /**
     * Событие "объект создан".
     *
     * @param ContestModelContract $item
     */
    public function created(ContestModelContract $item): void
    {
    }

    /**
     * Событие "объект обновляется".
     *
     * @param ContestModelContract $item
     */
    public function updating(ContestModelContract $item): void
    {
    }

    /**
     * Событие "объект обновлен".
     *
     * @param ContestModelContract $item
     */
    public function updated(ContestModelContract $item): void
    {
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param ContestModelContract $item
     */
    public function deleting(ContestModelContract $item): void
    {
    }

    /**
     * Событие "объект удален".
     *
     * @param ContestModelContract $item
     */
    public function deleted(ContestModelContract $item): void
    {
    }
}
