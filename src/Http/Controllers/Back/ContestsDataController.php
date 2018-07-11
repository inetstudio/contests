<?php

namespace InetStudio\Contests\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsDataControllerContract;

/**
 * Class ContestsDataController.
 */
class ContestsDataController extends Controller implements ContestsDataControllerContract
{
    /**
     * Используемые сервисы.
     *
     * @var array
     */
    public $services;

    /**
     * ContestsController constructor.
     */
    public function __construct()
    {
        $this->services['dataTables'] = app()->make('InetStudio\Contests\Contracts\Services\Back\ContestsDataTableServiceContract');
    }

    /**
     * Получаем данные для отображения в таблице.
     *
     * @return mixed
     */
    public function data()
    {
        return $this->services['dataTables']->ajax();
    }
}
