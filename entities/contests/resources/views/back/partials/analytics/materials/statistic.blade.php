@inject('contestsService', 'InetStudio\ContestsPackage\Contests\Contracts\Services\Back\ItemsServiceContract')

@php
    $contests = $contestsService->getItemsStatisticByStatus();
@endphp

<li>
    <small class="label label-default">{{ $contests->sum('total') }}</small>
    <span class="m-l-xs">Конкурсы</span>
    <ul class="todo-list m-t">
        @foreach ($contests as $contest)
            <li>
                <small class="label label-{{ $contest->status->color_class }}">{{ $contest->total }}</small>
                <span class="m-l-xs">{{ $contest->status->name }}</span>
            </li>
        @endforeach
    </ul>
</li>
