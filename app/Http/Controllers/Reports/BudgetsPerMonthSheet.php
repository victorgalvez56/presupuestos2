<?php

namespace App\Http\Controllers\Reports;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;

use App\Models\Budgets\DetailsBudgetModel;
use App\Models\Maintenance\MonthsModel;

class BudgetsPerMonthSheet implements FromQuery, WithTitle,WithHeadings
{
    private $month;
    private $year;

    public function __construct(int $year, int $month)
    {
        $this->month = $month;
        $this->year  = $year;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return DetailsBudgetModel::join('budgets', 'budgets.id', '=', 'details_budgets.budget_id')
        ->join('months', 'months.id', '=', "details_budgets.month_id")
        ->join('batchs', 'batchs.id', '=', "details_budgets.batch_id")
        ->join('areas', 'areas.id', '=', 'batchs.area_id')
        ->where('details_budgets.month_id', '=', $this->month)
        ->whereYear('details_budgets.created_at', '=', $this->year)
        ->select('months.name as name_month','areas.name as name_area', 'batchs.name as name_batch',
        'details_budgets.quantity','details_budgets.description','details_budgets.unit_price',
        'details_budgets.price_dollar','details_budgets.total_soles','details_budgets.total_dollars');

            // ->whereYear('created_at', $this->year)
            // ->whereMonth('created_at', $this->month);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        $months = MonthsModel::where('id','=',$this->month)->first();

        return $months->name;
    }
    public function headings(): array
    {
        return [
            'Mes',
            'Área',
            'Partida',
            'Cantidad',
            'Descripción',
            'Precio Unitario',
            'Precio del Dolar',
            'Total Soles',
            'Total Dolares'
        ];
    }
}