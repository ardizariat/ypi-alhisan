<div class="modal fade text-left modal-borderless" id="modal-logout" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <h5>
                    Apakah anda yakin ingin logout?
                </h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">Batal
                </button>
                <form action="{{ route('auth.logout') }}">
                    @csrf
                    @method('delete')
                    <button type="button" onclick="logout(this.form)" class="btn btn-primary ml-1">Ya, Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
