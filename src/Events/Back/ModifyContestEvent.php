<?php

namespace InetStudio\Contests\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\Contests\Contracts\Events\Back\ModifyContestEventContract;

/**
 * Class ModifyContestEvent.
 */
class ModifyContestEvent implements ModifyContestEventContract
{
    use SerializesModels;

    public $object;

    /**
     * ModifyContestEvent constructor.
     *
     * @param $object
     */
    public function __construct($object)
    {
        $this->object = $object;
    }
}
