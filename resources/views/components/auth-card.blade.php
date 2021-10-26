<main>
    <!-- Section -->
    <section class="vh-100 bg-soft d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center form-bg-image"
                data-background="{{ asset('impact/front/assets/img/illustrations/signin.svg') }}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div
                        class="signin-inner mt-3 mt-lg-0 bg-white shadow-soft border border-light rounded p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            {{ $header }}
                        </div>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
