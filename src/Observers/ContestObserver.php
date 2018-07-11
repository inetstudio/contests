<?php

namespace InetStudio\Contests\Observers;

use InetStudio\Contests\Contracts\Models\ContestModelContract;
use InetStudio\Contests\Contracts\Observers\ContestObserverContract;

/**
 * Class ContestObserver.
 */
class ContestObserver implements ContestObserverContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * ContestObserver constructor.
     */
    public function __construct()
    {
        $this->services['contestsObserver'] = app()->make('InetStudio\Contests\Contracts\Services\Back\ContestsObserverServiceContract');
    }

    /**
     * Событие "объект создается".
     *
     * @param ContestModelContract $item
     */
    public function creating(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->creating($item);
    }

    /**
     * Событие "объект создан".
     *
     * @param ContestModelContract $item
     */
    public function created(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->created($item);
    }

    /**
     * Событие "объект обновляется".
     *
     * @param ContestModelContract $item
     */
    public function updating(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->updating($item);
    }

    /**
     * Событие "объект обновлен".
     *
     * @param ContestModelContract $item
     */
    public function updated(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->updated($item);
    }

    /**
     * Событие "объект подписки удаляется".
     *
     * @param ContestModelContract $item
     */
    public function deleting(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->deleting($item);
    }

    /**
     * Событие "объект удален".
     *
     * @param ContestModelContract $item
     */
    public function deleted(ContestModelContract $item): void
    {
        $this->services['contestsObserver']->deleted($item);
    }
}
