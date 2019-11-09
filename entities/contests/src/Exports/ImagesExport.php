<?php

namespace InetStudio\ContestsPackage\Contests\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\ContestsPackage\Contests\Contracts\Exports\ImagesExportContract;

/**
 * Class ImagesExport.
 */
class ImagesExport implements ImagesExportContract, FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    use Exportable;

    /**
     * @var string
     */
    protected $data = [];

    /**
     * Data property setter.
     *
     * @param  array  $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * Получаем данные для экспорта.
     *
     * @return Collection
     *
     * @throws BindingResolutionException
     */
    public function collection()
    {
        $contestsService = app()->make('InetStudio\ContestsPackage\Contests\Contracts\Services\Front\ItemsServiceContract');

        $params = [
            'relations' => ['media'],
        ];

        return $contestsService->getItemBySlug($this->data['route']['slug'], $params)->first()->media;
    }

    /**
     * @param $media
     *
     * @return array
     */
    public function map($media): array
    {
        return [
            $media->id,
            $media->collection_name,
            $media->getCustomProperty('alt'),
            $media->getCustomProperty('description'),
            $media->getCustomProperty('copyright'),
            url($media->getFullUrl()),
        ];
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'collection',
            'alt',
            'description',
            'copyright',
            'url',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
