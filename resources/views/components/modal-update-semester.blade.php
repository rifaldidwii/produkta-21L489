<div class="modal fade" id="modal-update-semester-{{ $id }}" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-semester-{{ $id }}" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-success">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Konfirmasi</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="bi bi-bell-fill" style="font-size: 3rem;"></i>
                        <h4 class="heading mt-4">Apakah anda yakin untuk mengganti semester?</h4>
                        <p>Klik tombol "Ganti" dibawah ini untuk mengubah semester.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" href="#" onclick="event.preventDefault();
                        document.getElementById('update-form-{{ $id }}').submit();">Ganti</a>
                    <form id="update-form-{{ $id }}" action="{{ $action }}" method="POST" class="d-none">
                        @csrf
                        @method('PUT')
                    </form>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
