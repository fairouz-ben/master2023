{{-- <a href="{{ route('student_edit',$id) }}"  data-toggle="tooltip" data-original-title="Edit" class="edit btn btn-success edit">
    Modifier
    </a> --}}
    <button onclick="myFunction({{$id}})" data-original-title="Edit" class="edit btn btn-success edit">Modifier Etat</button>
{{--
   @if (  $is_deleted  == 1 )
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Active" class="active btn btn-info">
         <i class='fa fa fa-eye' ></i></a>
        </a>   
    @else
    <a href="javascript:void(0)" data-id="{{ $id }}" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger">
         <i class='fa fa fa-eye-slash' ></i></a>
        </a>   
    @endif 
--}}

   <a class=' btn btn-primary' data-value='{{$id}}' href="{{ route('student_edit',$id) }}"> Detail</a>
    
  

    