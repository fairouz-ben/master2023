@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
 <p> Welcome {{ Auth::user()->name }}</p> 

 @if (Auth::guard('admin')->user())
 {{-- Hello Admin! {{ Auth::guard('admin')->user()->name }} --}}
 @endif

</div>
@endsection