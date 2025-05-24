<x-layout>
    <section style="background-color: #dcf0fa; border-radius: 10px;">
        <div class="text-center container px-4 py-5 text-center">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="d-flex justify-content-center align-items-center gap-2 mb-4">
                            <span class="display-1 fw-bold">429</span>
                        </h2>
                        <h3 class="h2 mb-2">Oops! Too many requests.</h3>
                        <p class="mb-5">You're sending too many requests.</p>
                        <a class="btn bsb-btn-5xl btn-dark rounded-pill px-5 fs-6 m-0" href="{{ route('index') }}"
                            role="button">Back
                            to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>
