<x-guest-layout>
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('{{ asset('assets/front/assets/img/bg.jpg') }}');
            background-size: cover;
            background-position: center;
        }
        .card {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
        }
        .card-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-primary {
            width: 100%;
        }
        .btn-secondary {
            width: 100%;
            margin-top: 10px;
        }
    </style>
    <div class="login-container">
        <div class="card col-md-4">
            <div class="card-header">Iniciar Sesión</div><br>
            <div class="card-body">
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="form-control"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group form-check">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label for="remember_me" class="form-check-label">{{ __('Recuérdame') }}</label><br><br><br>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Olvidaste tu contraseña?') }}
                            </a><br><br>
                        @endif

                        <x-primary-button class="btn btn-primary">
                            {{ __('Entrar') }}
                        </x-primary-button>
                    </div><br>
                </form>
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    {{ __('Atrás') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
