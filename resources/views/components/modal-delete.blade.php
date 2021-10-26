<div class="modal fade" id="modal-delete-{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-delete-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
        <div class="modal-content bg-gradient-danger">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-notification">Peringatan</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-3 text-center">
                    <i class="bi bi-bell-fill" style="font-size: 3rem;"></i>
                    <h4 class="heading mt-4">Hapus Data {{ $name }}?
                    </h4>
                    <p>Klik tombol "Hapus" dibawah ini <br> untuk menghapus data.</p>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-white" href="#" onclick="event.preventDefault();
                    document.getElementById('delete-form-{{ $id }}').submit();">Hapus</a>
                <form id="delete-form-{{ $id }}" action="{{ $action }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
                <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>
