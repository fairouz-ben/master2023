<a href="{{ route('student_edit',$id) }}"  data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
    MMMM
    </a>


@if (  $is_deleted  == 1 )
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Active" class="active btn btn-info">
        <i class='fa fa fa-eye' ></i></a>
        </a>   
    @else
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
        bbbb
        </a>   
    @endif 


    