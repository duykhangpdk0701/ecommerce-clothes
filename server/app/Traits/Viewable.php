<?php

namespace App\Traits;

use App\Models\ViewActivity;

trait Viewable
{
    public function views()
    {
        return $this->morphMany(ViewActivity::class, 'viewable');
    }
}
