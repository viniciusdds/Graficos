<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\ReportsRepositoryInterface;

class ReportsController extends Controller
{
    public function __construct(ReportsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function months(ReportsChart $chart){

        $chart->labels(['JAN', 'FEV', 'MAR']);
        $chart->dataset('2018', 'bar', $this->repository->byMonths(2018));
        $chart->dataset('2019', 'bar', [
            12, 14, 16
        ])->options([
            'backgroundColor' => '#999'
        ]);

        

        return view('admin.charts.chart', compact('chart'));
    }
}
