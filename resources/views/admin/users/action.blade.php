
        
       
        <a class='btn btn-success' data-value='$data->id' target='_blank' href='{{route('user.edit', $data->id)}}'>Details</a> 
               <br/>  <br> 
        @if (  is_null($data->email_verified_at )) 
        <a href='javascript:void(0)' data-id='{{$data->id}}' data-toggle='tooltip' data-original-title='Active' class='active btn btn-danger'>
            <i class='fa fa fa-eye-slash' ></i>
           No valider
            </a> 
        
           <br>
        
        @else 
        <a href='javascript:void(0)'  data-id='{{$data->id}}' data-toggle='tooltip' data-original-title='Active' class='active btn btn-info'>
            <i class='fa fa fa-eye' ></i> 
             email valid</a>
            
        @endif