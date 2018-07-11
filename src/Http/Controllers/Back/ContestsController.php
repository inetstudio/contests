<?php

namespace InetStudio\Contests\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use InetStudio\Contests\Contracts\Http\Requests\Back\SaveContestRequestContract;
use InetStudio\Contests\Contracts\Http\Controllers\Back\ContestsControllerContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\FormResponseContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\SaveResponseContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\ShowResponseContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\IndexResponseContract;
use InetStudio\Contests\Contracts\Http\Responses\Back\Contests\DestroyResponseContract;

/**
 * Class ContestsController.
 */
class ContestsController extends Controller implements ContestsControllerContract
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
        $this->services['contests'] = app()->make('InetStudio\Contests\Contracts\Services\Back\ContestsServiceContract');
        $this->services['dataTables'] = app()->make('InetStudio\Contests\Contracts\Services\Back\ContestsDataTableServiceContract');
    }

    /**
     * Список объектов.
     *
     * @return IndexResponseContract
     */
    public function index(): IndexResponseContract
    {
        $table = $this->services['dataTables']->html();

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\IndexResponseContract', [
            'data' => compact('table'),
        ]);
    }

    /**
     * Получение объекта.
     *
     * @param int $id
     *
     * @return ShowResponseContract
     */
    public function show(int $id = 0): ShowResponseContract
    {
        $item = $this->services['contests']->getContestObject($id);

        return app()->makeWith(ShowResponseContract::class, [
            'item' => $item,
        ]);
    }

    /**
     * Создание объекта.
     *
     * @return FormResponseContract
     */
    public function create(): FormResponseContract
    {
        $item = $this->services['contests']->getContestObject();

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Создание объекта.
     *
     * @param SaveContestRequestContract $request
     *
     * @return SaveResponseContract
     */
    public function store(SaveContestRequestContract $request): SaveResponseContract
    {
        return $this->save($request);
    }

    /**
     * Редактирование объекта.
     *
     * @param int $id
     *
     * @return FormResponseContract
     */
    public function edit(int $id = 0): FormResponseContract
    {
        $item = $this->services['contests']->getContestObject($id);

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\FormResponseContract', [
            'data' => compact('item'),
        ]);
    }

    /**
     * Обновление объекта.
     *
     * @param SaveContestRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    public function update(SaveContestRequestContract $request, int $id = 0): SaveResponseContract
    {
        return $this->save($request, $id);
    }

    /**
     * Сохранение объекта.
     *
     * @param SaveContestRequestContract $request
     * @param int $id
     *
     * @return SaveResponseContract
     */
    private function save(SaveContestRequestContract $request, int $id = 0): SaveResponseContract
    {
        $item = $this->services['contests']->save($request, $id);

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\SaveResponseContract', [
            'item' => $item,
        ]);
    }

    /**
     * Удаление объекта.
     *
     * @param int $id
     *
     * @return DestroyResponseContract
     */
    public function destroy(int $id = 0): DestroyResponseContract
    {
        $result = $this->services['contests']->destroy($id);

        return app()->makeWith('InetStudio\Contests\Contracts\Http\Responses\Back\Contests\DestroyResponseContract', [
            'result' => (!! $result),
        ]);
    }
}
