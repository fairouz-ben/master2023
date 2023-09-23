<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">traitement</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('student_update',0) }}" method="post">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id_st" id="id_st" value="-" required>
            <div class="form-group">
              <label for="etat">Etat</label>
              <select  class="form-control" name="etat" id="etat" required>
                <option value="Accepté">Accepté</option>
                <option value="Refusé">Refusé</option>
                <option value="Non traité" selected>Non traité</option>
              </select>
            </div>

            <div class="form-group">
              <label for="motif">motif</label>
              <select class="form-control" id="motif" name="motif" required disabled>
                <option value="null" selected> -<option>
                <option value="1">1- Dossier incomplet</option>
                <option value="2">2- Fichier endommagé</option>
                <option value="3">3- Spécialité inacceptable</option>
                <option value="4">4- Pas places pédagogiques</option>
                <option value="5">5- Autre: précisé:………</option>
              </select>
            </div>

            <div class="form-group">
              <label for="oriented_to_speciality">Orientation</label>
              <select disabled name="oriented_to_speciality" id="oriented_to_speciality" required  class="form-control">
                <option value="">....</option>
              </select>
            </div>
            <div class="row m-4">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button   type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>
 