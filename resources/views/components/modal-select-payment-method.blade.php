<div class="modal fade" id="modal-select-payment-method-{{ $id }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-select-payment-method-{{ $id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" action="{{ $action }}">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-select-payment-method">Metode Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="payment_method">Pilih Metode Pembayaran</label>
                        <select class="form-control" id="payment_method" name="payment_method">
                            <option value="BRIVA">Bank BRI</option>
                            <option value="BNIVA">Bank BNI</option>
                            <option value="MANDIRIVA">Bank Mandiri</option>
                            <option value="BCAVA">Bank BCA</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Bayar</button>
                </div>
            </div>
        </form>
    </div>
</div>
