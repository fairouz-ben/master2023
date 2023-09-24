<?php

namespace App\DataTables;

use App\Models\Student;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class StudentsDataTable extends  DataTable
{
    private $DepIds=[];

    public function setDepIds($user_dep_Id)
    {
        $this->DepIds = $user_dep_Id;
    }

     /////////////////////////////////first//////////////////////////////////
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        
        ->addColumn('action',function ($data){
            return $this->getActionColumn($data);
        })
        ->addColumn('link', function($row){
                $btn = '<a href="'. route('admin.show_uploaded_file',$row->id).'" >PDF doc</a>';
                return $btn; 
            })
            ->editColumn("nom_ar",function($student){
        
                return view("admin.students.fullName")->with("student",$student);
            })
            ->editColumn('department_id',function ($student){
                return ($student->department->name_fr);
            })
            
            ->editColumn('special_1',function ($student){
                $iteration = 1; 
                $sp_list=[];
                 foreach($student->speciality_students as $sp){
                    $sp_list []= $iteration++ .': '.$sp->speciality->title_fr.' ('.$sp->speciality->id.') / ';
                    
                }
                return $sp_list;
            })
        ->rawColumns(['link', 'action'])    
                
            //->setRowId('id')//;
            ->setRowId(function ($user) {
                return $user->id;
            })
            ->setRowClass(function ($data) {
                if ($data->etat == 'Accepté' ) return 'table-success' ;
                if ($data->etat == 'Refusé' )  return  'table-danger';
                //if ($data->etat == 'Non traité' )  return  'table-warning';
            })
            /*->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })*/
            ->editColumn('id', 'edit');
            
    }
    protected function getActionColumn($data): string
    {
        
        
        $detailstUrl = route('select.student',['user'=>$data->user_id]) ;
        if (  $data->is_deleted  == 1 ){
        $dt="<a href='javascript:void(0)'  data-id=' $data->id' data-toggle='tooltip' data-original-title='Active' class='active btn btn-info'>
            <i class='fa fa fa-eye' ></i></a>
            </a>   ";
        } 
        else {
        $dt="<a href='javascript:void(0)' data-id='$data->id' data-toggle='tooltip' data-original-title='Delete' class='delete btn btn-danger'>
            <i class='fa fa fa-eye-slash' ></i></a>
            </a>  "; 
            }
        return "<a class='btn btn-success' data-value='$data->id' target='_blank' href='$detailstUrl'>Details</a> 
                <button class='edit btn btn-info m-2'data-edit='$data' > <i class='fa fa-edit'></i></button>
                <br\>   <br\> "; //$dt
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model): QueryBuilder
    {
      
        $query = $model->newQuery();
        if ($this->DepIds) {
            $query->whereIn('department_id', $this->DepIds );
                
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
                    ->setTableId('students-table')
                    
                    ->columns($this->getColumns())
                    ->lengthMenu(['10', '25', '50', '100','200'], [10, 25, 50, 100,200])
                    ->responsive(true)
                    ->searching(true)
                    ->pageLength(100)
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->stateSave(true)
                    ->orderBy(0, 'ASC')
                    ->buttons([
                        Button::make('pageLength'),//(['extend' => 'pageLength', 'className' => 'dropdown-toggle btn btn-info'])->text('Nombre de lignes'),
                        //Button::make('excel'),
                       // Button::make('csv'),
                        Button::make(['extend' => 'csv', 'className' => 'btn btn-info ml-1'])->text('Export as CSV'),
                        //Button::make('pdf'),
                        Button::make(['extend' => 'print', 'className' => 'btn btn-info ml-1'])->text('Impression'),
                        
                        Button::make(['extend' => 'excel', 'className' => 'btn btn-info ml-1'])->text('Excel'),
                        
                       // Button::make(['extend' => 'reload', 'className' => 'btn btn-info ml-1'])->text('Reload'),
                       //Button::make('reset'),
                        Button::make(['extend' => 'reset', 'className' => 'btn btn-info ml-1'])->text('Reset'),
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
            Column::make('id')->hidden()->printable(false)->searchable(false)->exportable(false),         
          //  Column::make('nom_ar')->title( 'Nom' )->searchable(true),
           // Column::make('prenom_ar'),
            Column::make('nom_fr'),
            Column::make('prenom_fr'),
            Column::make('department_id')->title( 'Department' )->searchable(true),
            Column::make('special_1')->title( 'Spécialités' )->searchable(true),
            Column::make('moy_classement')->title( 'moyenne de classement' )->searchable(true),
           // Column::make('phone'),
           // Column::make('mat_bac'),
            Column::computed('link')
            ->exportable(true)
            ->printable(false)
            ->width(80)->delete()
            ->addClass('text-center'),

            Column::make('etat')->width(80),

            Column::computed('action')
            ->exportable(true)
            ->printable(false)
            ->width(80)->delete()
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Students_' . date('YmdHis');
    }
}
