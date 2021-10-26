<div class="header bg-primary pb-6 d-print-none">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <a href="javascript:history.back()" class="h2 text-white d-inline-block mb-0 mr-2">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <h6 class="h2 text-white d-inline-block mb-0">{{ $text }}</h6>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</div>
