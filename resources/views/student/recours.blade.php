
@if (is_null($student->recours))

@if ($student->faculty->recoure_is_valid)
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recoursModal">
  <i class="bi bi-chat-dots"></i> الطــعــن
</button>
@else
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        تنبيه
        <br>
        إنتهت مدة الطعن
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="قريب"></button>
    </div>
@endif
@else
<div class="form-group">
    <label for="recours">النص</label>
    <textarea name="recours" id="" cols="30" rows="5" readonly class="form-control">{{ $student->recours }}</textarea>

</div>
<div class="form-group">
    <label for="recours_reponse">الرد</label>
    @if (!is_null($student->recours_reponse))
        <textarea name="recours_reponse" id="" cols="30" rows="5" readonly class="form-control">{{ $student->recours_reponse }}</textarea>
    @else
        لم يتم الرد بعد
    @endif

</div>

@endif




<!-- Modal -->
<div class="modal fade" id="recoursModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">الطعن</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('recours') }}" method="post">
                    @csrf
                    @method('PATCH')

                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                تنبيه
                                <br>
                                لديكم الحق في تقديم الطعن مرة واحدة فقط

                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="قريب"></button>
                            </div>
                            <div class="form-group">
                                <label for="recours">النص</label>
                                <textarea name="recours" required id="" cols="30" rows="5" class="form-control">{{ old('recours') }}</textarea>
                                @error('recours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

            </div>


            <div class="modal-footer">
                @if (is_null($student->recours) && $student->faculty->recoure_is_valid)
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-primary">{{ __('translation.save') }}</button>
                    <div id="emailHelp" class="form-text">تأكد جيدا قبل الحفظ</div>
                @endif
            </div>
            </form>
        </div>
    </div>
</div>
