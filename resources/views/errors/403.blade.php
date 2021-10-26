<x-auth-layout>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                        <div>
                            <img class="img-fluid w-75"
                                src="{{ asset('impact/front/assets/img/illustrations/403.svg') }}"
                                alt="403 forbidden">
                            <h1 class="mt-5">Access <span class="font-weight-bolder text-primary">forbidden</span></h1>
                            <p class="lead my-4">The page you're trying to access has restricted access. Please refer to your system administrator.</p>
                            <a class="btn btn-primary animate-hover" href="{{ route('home') }}">
                                Go back home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-auth-layout>
