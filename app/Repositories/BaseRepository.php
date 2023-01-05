<?php
declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

abstract class BaseRepository
{
    abstract protected function getModel();

    protected function query(): Builder
    {
        return $this
            ->getModel()
            ->newQuery();
    }
}
