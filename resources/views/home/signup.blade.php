<x-layout>

    <div class="signup-form">
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
                <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                <form action="{{ url('register') }}" method="post">
                    @csrf
                    <div class="form-outline mb-4">
                        @error('name')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="text" id="form3Example1cg"
                            class="form-control form-control-lg @error('name') border border-danger @enderror"
                            name="name" />
                        <label class="form-label" for="form3Example1cg">Your Name</label>
                    </div>

                    <div class="form-outline mb-4">
                        @error('email')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="email" id="form3Example3cg"
                            class="form-control form-control-lg @error('email') border border-danger @enderror"
                            name="email" />
                        <label class="form-label" for="form3Example3cg">Your Email</label>
                    </div>

                    <div class="form-outline mb-4">
                        @error('password')
                            <p class="error">{{ $message }}</p>
                        @enderror
                        <input type="password" id="form3Example4cg"
                            class="form-control form-control-lg @error('password') border border-danger @enderror"
                            name="password" />
                        <label class="form-label" for="form3Example4cg">Password</label>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="password" id="form3Example4cdg"
                            class="form-control form-control-lg @error('password') border border-danger @enderror"
                            name="password_confirmation" />
                        <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit"
                            class="btn btn-secondary btn-block btn-lg gradient-custom-4 text-body w-100">Register</button>
                    </div>

                    <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="{{ route('login') }}"
                            class="fw-bold text-body"><u>Login here</u></a></p>

                </form>

            </div>
        </div>
    </div>
</x-layout>
