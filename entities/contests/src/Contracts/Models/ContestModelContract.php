<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use InetStudio\Rating\Contracts\Models\Traits\RateableContract;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;

/**
 * Interface ContestModelContract.
 */
interface ContestModelContract extends BaseModelContract, Auditable, HasMedia, RateableContract
{
}
