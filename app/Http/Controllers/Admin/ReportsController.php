<?php

namespace App\Http\Controllers\Admin;

use App\Charts\ReportsChart;
use App\Enum\Enum;
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

        $chart->labels(Enum::months());

        $chart->dataset('2018', 'bar', $this->repository->byMonths(2018));

        $chart->dataset('2019', 'bar', $this->repository->byMonths(2019))
        ->options([
            'backgroundColor' => '#999'
        ]);

        

        return view('admin.charts.chart', compact('chart'));
    }

    public function months2(){
        $chart = $this->repository->getReports(2016, 2018, 'line');

        return view('admin.charts.chart', compact('chart'));
    }

    public function year(ReportsChart $chart){

        $response = $this->repository->getDataYears();

        //dd($response);

        $chart->labels($response['labels'])
              ->dataset('Relatórios de vendas', 'bar', $response['values'])
              //->dataset('Relatórios de vendas', 'line', $response['values'])
              //->backgroundColor($response['backgrounds']);
              ->color('rgba(75, 192, 192)')
              //->color('black')
              //->backgroundColor($response['backgrounds']);
              ->backgroundColor('rgba(0, 0, 0, 0.1)');
        
        $chart->options([
            'scales' => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'callback' => $chart->rawObject('myCallback')
                        ]
                    ]
                ]
            ]
        ]);

        return view('admin.charts.chart', compact('chart'));
    }
}
