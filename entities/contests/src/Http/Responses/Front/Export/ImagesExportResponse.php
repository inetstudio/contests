<?php

namespace InetStudio\ContestsPackage\Contests\Http\Responses\Front\Export;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use InetStudio\ContestsPackage\Contests\Contracts\Exports\ImagesExportContract;
use InetStudio\ContestsPackage\Contests\Contracts\Http\Responses\Front\Export\ImagesExportResponseContract;

/**
 * Class ImagesExportResponse.
 */
class ImagesExportResponse implements ImagesExportResponseContract
{
    /**
     * @var ImagesExportContract
     */
    protected $export;

    /**
     * ImagesExportResponse constructor.
     *
     * @param  ImagesExportContract  $export
     */
    public function __construct(ImagesExportContract $export)
    {
        $this->export = $export;
    }

    /**
     * Экспорт данных.
     *
     * @param  Request  $request
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        $data = [
            'route' => $request->route()->parameters(),
            'request' => $request->all(),
        ];

        $this->export->setData($data);

        return Excel::download($this->export, time().'.xlsx');
    }
}
