<x-auth-layout>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center d-flex align-items-center justify-content-center">
                        <div>
                            <img class="img-fluid w-75"
                                src="{{ asset('impact/front/assets/img/illustrations/404.svg') }}"
                                alt="404 not found">
                            <h1 class="mt-5">Page not <span class="font-weight-bolder text-primary">found</span></h1>
                            <p class="lead my-4">Oops! Looks like you followed a bad link. If you think this is a
                                problem with us,
                                please tell us.</p>
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
