<x-auth-layout>
    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-6 order-2 order-lg-1 text-center text-lg-left">
                        <h1 class="mt-5">Something has gone <span class="text-primary">seriously</span> wrong</h1>
                        <p class="lead my-4">It's always time for a coffee break. We should be back by the time you
                            finish your
                            coffee.</p>
                        <a class="btn btn-primary animate-hover" href="{{ route('home') }}">Go back home</a>
                    </div>
                    <div
                        class="col-12 col-lg-6 order-1 order-lg-2 text-center d-flex align-items-center justify-content-center">
                        <img class="img-fluid w-75"
                            src="{{ asset('impact/front/assets/img/illustrations/500.svg') }}"
                            alt="500 Server Error">
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-auth-layout>
