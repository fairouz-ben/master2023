<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    protected $FacId= null;
    public function setFacId($id)
    {
        $this->FacId=$id;
    }
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            
            ->addColumn('action',function ($data){ 
                return view('admin.users.action')->with("data",$data);
             })
            ->setRowId('id');
    }
    protected function getActionColumn($data): string
    {
        
        $detailstUrl = route('user_details', $data->id);
        if (  $data->is_deleted  == 1 ){
        $dt="<a href='javascript:void(0)'  data-id=' $data->id' data-toggle='tooltip' data-original-title='Active' class='active btn btn-info'>
            <i class='fa fa fa-eye' ></i></a>
            </a>   ";
        } 
        else {
        $dt="<a href='javascript:void(0)' data-id='$data->id' data-toggle='tooltip' data-original-title='Active' class='active btn btn-danger'>
            <i class='fa fa fa-eye-slash' ></i></a>
            </a>  "; 
            }
        return "<a class='btn btn-success' data-value='$data->id' target='_blank' href='$detailstUrl'>Details</a> 
                <button class='edit btn btn-info m-2'data-edit='$data' > <i class='fa fa-edit'></i></button>
                <br\>   <br\> $dt";
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        $query = $model->newQuery();

        if ($this->FacId && $this->FacId !== 'all' ) {
            $query->where('faculty_id', $this->FacId);
        }
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->lengthMenu(['50', '100','200','500'], [ 50, 100,200,500])
                    ->responsive(true)
                    ->searching(true)
                    ->pageLength(100)
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        //Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(120)
                  ->addClass('text-center'),
            Column::make('id')->hidden()->printable(false)->searchable(false)->exportable(false),         
            
            Column::make('name')->title('Nom'),
            Column::make('lastname')->title('Prenom'),
            Column::make('email')->title('Email'),
            Column::make('birthday')->title('Date de naissance'),
            Column::make('licence_type')->title( 'licence type' )->searchable(true), 
            // Column::make('phone'),
          
            Column::make('email_verified_at'),//->title('active'), 
            //Column::make('created_at'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
