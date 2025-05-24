<x-layout>

    <form class="login-form" action="{{ route('loginPost') }}" method="post">
        @csrf
        <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
                <!-- Email input -->
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form-outline mb-4">
                    <input type="email" id="form2Example1"
                        class="form-control @error('email') border border-danger @enderror" name="email" />
                    <label class="form-label" for="form2Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <input type="password" id="form2Example2"
                        class="form-control @error('password') border border-danger @enderror" name="password" />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                    <div class="col d-flex justify-content-center">
                        <!-- Checkbox -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="form2Example31" />
                            <label class="form-check-label" for="form2Example31"> Remember me </label>
                        </div>
                    </div>

                    <div class="col">
                        <!-- Simple link -->
                        <a href="#!">Forgot password?</a>
                    </div>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4 w-100">Sign
                    in</button>

                <!-- Register buttons -->
                <div class="text-center">
                    <p>Not a member? <a href="{{ route('signup') }}">Register</a></p>
                </div>
                @error('failed')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </form>

</x-layout>
