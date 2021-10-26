@if(session($type))
    <div class="alert alert-{{ $type }} alert-dismissible fade show mx-4 mt-4" role="alert">
        <span class="alert-icon"><i class="bi bi-exclamation-circle-fill"></i></span>
        <span class="alert-text"><strong>Pesan: </strong>
            {!! session($type) !!}</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
