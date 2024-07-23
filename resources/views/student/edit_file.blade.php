<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-file-earmark-arrow-down"></i> {{ __('translation.edit_file') }}
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> {{ __('translation.edit_file') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                {{-- @if(middleware(['auth:admin']))

                {{ $routeName = 'adminstorefile' }}
            @else
                {{ $routeName = 'storefile' }}
                @endif --}}
                <form action="{{ route($routeName, ['student' => $student->id]) }}" method="post"
                    enctype="multipart/form-data">{{-- need to use route to easy insert parameter department_id --}}
                    @csrf

                    <div class="form-group g-4">
                        <label class="col-md-6 col-form-label ">{{ __('translation.upload_file') }}: </label>

                    </div>
                    <div class="row g-7">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ __('translation.doc_alert_message') }}
                            <ul>
                                <li> - شهادة البكالوريا</li>
                                <li>- شهادة الليسانس/ الدبلوم</li>
                                <li>- كشوف النقاط</li>
                            </ul>

                            {{-- <a href="{{asset('fichiers_joints.pdf')}}" class="alert-link">fichiers joints </a>. --}}

                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>

                        <div class="col-md-8 pt-3" dir="ltr">
                            <input id="file" type="file" accept="application/pdf" class="form-control "
                                name="file" required="">
                            <div id="emailHelp" class="form-text">{{ __('translation.doc_alert_message') }}</div>

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row m-4">
                        <button class="btn btn-primary">{{ __('translation.save') }}</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('translation.cancel') }}</button>

            </div>

        </div>

    </div>
</div>
{{-- -------End-Modal--------- --}}
