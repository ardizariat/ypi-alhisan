<div class="modal fade text-left modal-borderless" id="modal-ganti-password" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.update-password', auth()->id()) }}">
                @csrf
                @method('put')
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-3">
                                <h6 class="mt-2">Password Lama</h6>
                            </div>
                            <div class="col-md-9 form-group">
                                <input autofocus autocomplete="off" type="password" class="form-control"
                                    name="password_lama" placeholder="Password lama anda">
                            </div>
                            <div class="col-md-3">
                                <h6 class="mt-2">Password Baru</h6>
                            </div>
                            <div class="col-md-9 form-group">
                                <input autocomplete="off" type="password" class="form-control" name="password"
                                    placeholder="Password baru anda">
                            </div>
                            <div class="col-md-3">
                                <h6 class="mt-2">Konfirmasi Password Baru</h6>
                            </div>
                            <div class="col-md-9 form-group">
                                <input autocomplete="off" type="password" class="form-control"
                                    name="password_confirmation" placeholder="Konfirmasi password baru anda">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                        <span class="d-sm-block">Tutup</span>
                    </button>
                    <button onclick="gantiPassword(this.form)" type="submit"
                        class="btn btn-save btn-success me-1 mb-1">
                        Update
                        <span class="spinner-grow loading-img text-light spinner-grow-sm d-none" role="status"
                            aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
