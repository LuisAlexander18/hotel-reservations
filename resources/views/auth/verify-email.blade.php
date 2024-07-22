@extends('layouts.template')

@section('header')
<header class="header-2">
    <div class="page-header min-vh-75 relative">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 text-center mx-auto">
                    {{ __('Necesitas verificar tu dirección de correo electrónico durante el registro.') }}
                </div>
                <div class="col-lg-7 text-center mx-auto mt-4">
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="mb-3">
                            <button class="btn btn-primary">
                                {{ __('Reenviar correo de verificación') }}
                            </button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-link">
                            {{ __('Cerrar sesión') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('contenido')
@endsection
