<?php

namespace InetStudio\ContestsPackage\Contests\Contracts\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use InetStudio\Rating\Contracts\Models\Traits\RateableContract;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;
use InetStudio\Favorites\Contracts\Models\Traits\FavoritableContract;

/**
 * Interface ContestModelContract.
 */
interface ContestModelContract extends BaseModelContract, Auditable, FavoritableContract, HasMedia, RateableContract
{
}
