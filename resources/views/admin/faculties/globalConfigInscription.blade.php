
  
  <!-- Modal -->
  <div class="modal fade" id="globalConfigInscription" tabindex="-1" aria-labelledby="globalConfigInscriptionLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="globalConfigInscriptionLabel">Global config: Inscription</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('faculties.globalConfigInscription')}}" method="post">
            @csrf
        <div class="modal-body">
          
        <div class="form-group">
            <label for="inscription_close_date">inscription_close_date</label>
            <input type="date" class="form-control" name="inscription_close_date" value="" >
          </div>
        
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