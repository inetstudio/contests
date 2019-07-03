<?php

namespace InetStudio\ContestsPackage\Contests\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\ContestsPackage\Contests\Contracts\Models\ContestModelContract;
use InetStudio\ContestsPackage\Contests\Contracts\Events\Back\ModifyItemEventContract;

/**
 * Class ModifyItemEvent.
 */
class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    /**
     * @var ContestModelContract
     */
    public $item;

    /**
     * ModifyItemEvent constructor.
     *
     * @param  ContestModelContract  $item
     */
    public function __construct(ContestModelContract $item)
    {
        $this->item = $item;
    }
}
