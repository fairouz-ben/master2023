<?php

namespace App\DataTables;

use App\Models\Student;
use GuzzleHttp\Middleware;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class StudentsDataTable extends  DataTable
{


    protected $DepIds = [];
    protected $LicenceType = '';

    public function setLicenceType($type)
    {
        $this->LicenceType = $type;
    }
    public function getLicenceType()
    {
        return $this->LicenceType;
    }

    public function setDepIds($user_dep_Id)
    {
        $this->DepIds = $user_dep_Id;
    }
    public function getDepIds()
    {
        return $this->DepIds;
    }
    private $rowIndex = 0;



    /////////////////////////////////first//////////////////////////////////
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            })
            ->addColumn('link', function ($row) {
                $btn = '<a href="' . route('admin.show_uploaded_file', $row->id) . '" >PDF doc</a>';
                return $btn;
            })
            ->addColumn('line_number', function ($student) {
                $detailstUrl = route('select.student', ['user' => $student->user_id]);
                $this->rowIndex++;
                // return " <a class='btn btn-success' data-value='$student->id' target='_blank' href='$detailstUrl'>". $this->rowIndex."</a>"  ;
                return $this->rowIndex;
            })
            ->editColumn("nom_ar", function ($student) {

                //return view("admin.students.fullName")->with("student",$student);
                return $student->nom_ar . ' ' . $student->prenom_ar;
            })
            ->editColumn("nom_fr", function ($student) {

                return $student->nom_fr . ' ' . $student->prenom_fr;
            })
            ->editColumn('department_id', function ($student) {
                return ($student->department->name_fr);
            })
            ->editColumn('faculty_id', function ($student) {
                return ($student->faculty->name_fr);
            })

            ->editColumn('special_1', function ($student) {
                $iteration = 1;
                $sp_list = [];
                foreach ($student->speciality_students as $sp) {
                    $sp_list[] = $iteration++ . ': ' . $sp->speciality->title_fr . ' (' . $sp->speciality->id . ') / ';
                }
                return $sp_list;
            })
            ->editColumn('oriented_to_speciality', function ($student) {

                $oriented_to_sp = "";

                foreach ($student->speciality_students as $sp) {
                    if ($student->oriented_to_speciality == $sp->speciality->id) {
                        $oriented_to_sp = $sp->speciality->title_fr . ' (' . $sp->speciality->id . ') ';
                    }
                }
                return $oriented_to_sp;
            })
            ->rawColumns(['link', 'action', 'line_number'])

            //->setRowId('id')//;
            ->setRowId(function ($user) {
                return $user->id;
            })
            ->setRowClass(function ($data) {
                if ($data->etat == 'Accepté') return 'table-success';
                if ($data->etat == 'Refusé')  return  'table-danger';
                //if ($data->etat == 'Non traité' )  return  'table-warning';
            })
            /*->setRowClass(function ($user) {
                return $user->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            })*/
            ->editColumn('id', 'edit');
    }
    protected function getActionColumn($data): string
    {



        $detailstUrl = route('select.student', ['user' => $data->user_id]);
        if ($data->is_deleted  == 1) {
            $dt = "<a href='javascript:void(0)'  data-id=' $data->id' data-toggle='tooltip' data-original-title='Active' class='active btn btn-info'>
            <i class='fa fa fa-eye' ></i></a>
            </a>   ";
        } else {
            $dt = "<a href='javascript:void(0)' data-id='$data->id' data-toggle='tooltip' data-original-title='Delete' class='delete btn btn-danger'>
            <i class='fa fa fa-eye-slash' ></i></a>
            </a>  ";
        }
        if ( Auth::guard('admin')->user()->hasRole('administrator') ||  Auth::guard('admin')->user()->hasRole('manager')) {
            return "<a class='btn btn-success' data-value='$data->id' target='_blank' href='$detailstUrl'>Details</a> 
                <button class='edit btn btn-info m-2'  data-id='$data->id' data-etat='$data->etat'  data-motif='$data->motif' data-oriented_to_speciality='$data->oriented_to_speciality' > Etat <i class='fa fa-edit'></i></button>
                <br\>   <br\> "; //$dt
        } else
            return "<a class='btn btn-success' data-value='$data->id' target='_blank' href='$detailstUrl'>Details</a> 
                 <br\> "; //$dt
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
            $query->whereIn('department_id', $this->DepIds);
        }

        if ($this->LicenceType) {
            $query->where('licence_type', $this->LicenceType);
        }
        $query->orderby('moy_classement', 'desc');

        //Log::info('Generated Query', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);

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
            ->lengthMenu(['10', '25', '50', '100', '200'], [10, 25, 50, 100, 200])
            ->responsive(true)
            ->searching(true)
            ->pageLength(100)
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->stateSave(true)
            ->orderBy(6, 'desc') //'ASC'
            ->parameters([
                'buttons' => ['colvis'],
                // Other DataTables options
            ])
            ->buttons([

                Button::make('pageLength'), //(['extend' => 'pageLength', 'className' => 'dropdown-toggle btn btn-info'])->text('Nombre de lignes'),
                //Button::make('excel'),
                // Button::make('csv'),
                //   Button::make(['extend' => 'csv', 'className' => 'btn btn-info ml-1'])->text('Export as CSV'),
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
            Column::make('line_number')->title('N°')->searchable(false),
            Column::make('nom_ar')->title('Nom Ar')->searchable(true),
            // Column::make('prenom_ar'),
            Column::make('nom_fr')->searchable(true),
            //  Column::make('prenom_fr'),

            Column::make('date_nais')->width(90), //add
            // Column::make('mat_bac'),//add
            // Column::make('year_bac'),//add
            // Column::make('univ_origine'),//add
            // Column::make('licence'),//add 
            // Column::make('faculty_id')->title( 'facultés' )->searchable(true),//ddd

            Column::make('department_id')->title('Department')->searchable(true),
            // Column::make('special_1')->title( 'Spécialités sélectionnées' )->searchable(true)->exportable(true),
            Column::make('moy_classement')->title('moyenne de classement')->searchable(true)->width(50),

            Column::make('licence_type')->title('licence')->searchable(true),
            // Column::make('phone'),
             Column::make('mat_bac'),
            Column::computed('link')
                ->exportable(false)
                ->printable(false)
                ->width(50)->delete()
                ->addClass('text-center'),

            Column::make('etat')->width(50),
            Column::make('oriented_to_speciality')->title('orienté vers')->searchable(true),

            Column::computed('action')
                ->exportable(true)
                ->printable(false)
                ->width(80)->delete()
                ->exportable(false)
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
