
<!-- Modal -->
<div class="modal fade" id="editModal-{{$conf->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel-{{$conf->id}}">edit config</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('appconfig.update',$conf->id)}}" method="post">
                    @csrf
                    {{-- <div class="form-group">
                        <label for="key">Key: {{$conf->key}}</label>
                        <input type="text" class="form-control" name="key" value="{{$conf->key}}" required readonly>
                    </div> --}}
                    <input type="hidden" name="key" value="{{$conf->key}}">
                    <div class="form-group">
                        <label for="value">value of {{$conf->key}}</label>
                        <input type="{{$conf->data_type}}" class="form-control" name="value" value="{{$conf->value}}" >
                    </div>
                   
                    <div class="row m-4">
                        <button class="btn btn-primary">edit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>
