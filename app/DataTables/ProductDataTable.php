<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable{

    public function dataTable($query){
        return datatables()
            ->eloquent($query)
            ->editColumn('selection', function($product){
                return view('product.datatables_check', compact('product'));
            })
            ->addColumn('action', 'product.datatables_action');
    }

    public function query(Product $model){
        return $model->newQuery();
    }

    public function html(){
        return $this->builder()
                    ->setTableId('productdatatable-table')
                    ->columns($this->getColumns())
                    ->addAction(['title' => 'Action', 'width' => '150px', 'printable' => false, 'responsivePriority' => '100', 'id' => 'actionColumn'])
                    ->minifiedAjax()
                    ->orderBy(1);
    }

    protected function getColumns(){
        $columns = [
            [
                'data'  => 'selection',
                'name'  => '#',
                'title'  => "<input type='checkbox' name='check_all' id='check_all'>",
                'width' => '3%',
                'orderable' => false,
                'exportable' => false,
                'printable' => false,
                'searchable' => false
            ],
            [
                'data' => 'id',
                'visible' => false
            ],
            [
                'data' => 'product_name',
                'title' => 'Nama Menu'
            ],
        ];

        return $columns;
    }

    protected function filename(){
        return 'Product_' . date('YmdHis');
    }
}
