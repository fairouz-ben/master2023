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
              <select  class="form-select" name="etat" id="etat" required>
                <option value="Accepté">Accepté</option>
                <option value="Refusé">Refusé</option>
                <option value="Non traité" selected>Non traité</option>
              </select>
            </div>

            <div class="form-group">
              <label for="motif">السبب/motif</label>
              <input type="text" list="list_motif" name="motif" id="motif"  class="form-control"/>
            
              <datalist id="list_motif">
                <option >ملف غير مكتمل</option>
                <option > ملف تالف</option>
                <option >تخصص غير مقبول</option>
                <option >لا توجد أماكن بيداغوجية</option>
                <option >أخرى: حدد…</option>
                {{--  <option >Dossier incomplet</option>
                <option >Fichier endommagé</option>
                <option >Spécialité inacceptable</option>
                <option >Pas places pédagogiques</option>
                <option >Autre: précisé…</option> --}}
              </datalist>
             
            </div>

            <div class="form-group">
              <label for="oriented_to_speciality">Orientation</label>
              <select  name="oriented_to_speciality" id="oriented_to_speciality" required  class="form-select">
                
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
 