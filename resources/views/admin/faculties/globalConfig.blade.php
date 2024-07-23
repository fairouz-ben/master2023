
  
  <!-- Modal -->
  <div class="modal fade" id="globalconfig" tabindex="-1" aria-labelledby="globalconfigLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="globalconfigLabel">Global config: </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('faculties.globalconfig')}}" method="post">
            @csrf
        <div class="modal-body">
          
        <div class="form-group">
            <label for="inscription_close_date">inscription_close_date</label>
            <input type="date" class="form-control" name="inscription_close_date" value="" >
          </div>
          <div class="form-group">
            <label for="update_close_date">update_close_date</label>
            <input type="date" class="form-control" name="update_close_date" value="" >
          </div>
          <div class="form-group">
            <label for="treatment_close_date">treatment_close_date</label>
            <input type="date" class="form-control" name="treatment_close_date" value="" >
          </div>

          <div class="form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="show_result"  > 
              <label class="form-check-label" for="show_result">show_result</label>
            </div>
        </div>
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
           
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
          </svg>
          <div class="form-group m-3">
          <div class="alert alert-warning d-flex align-items-center " role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
                This data will be applied for all faculties
            </div>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
      </div>
    </div>
  </div>