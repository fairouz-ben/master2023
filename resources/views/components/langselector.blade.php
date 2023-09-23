<div class="dropdown">

    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      {{__('translation.btn')}}
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
      <li><a class="dropdown-item" href="{{route('switchLan','ar')}}">{{__('translation.arabic')}}</a></li>
      <li><a class="dropdown-item" href="{{route('switchLan','fr')}}">{{__('translation.french')}}</a></li>
      {{-- <li><a class="dropdown-item" href="{{route('switchLan','en')}}">{{__('translation.english')}}</a></li> --}}
    </ul>
  </div>