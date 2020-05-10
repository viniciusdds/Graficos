<?php

namespace App\Repositories\Core\QueryBuilder;

use App\Repositories\Contracts\ReportsRepositoryInterface;
use App\Repositories\Core\BaseQueryBuilderRepository;

class QueryBuilderReportsRepository extends BaseQueryBuilderRepository implements ReportsRepositoryInterface
{
    protected $table = 'products';

    public function byMonths(int $year):array
    {
        return [12, 13, 14];
    }
}