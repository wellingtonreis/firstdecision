@extends('layouts.default')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="form-container w-100" style="max-width: 500px;">
        @if(Session::has('success')) <div class="alert alert-success"> {{ Session::get('success') }} </div> @endif
        @if(Session::has('error')) <div class="alert alert-danger"> {{ Session::get('error') }} </div> @endif
        <h2 class="text-center mb-4">Registro de Usuário</h2>
        <form action="{{ route('register.create') }}" method="POST" novalidate>
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Digite seu nome">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required placeholder="Digite seu e-mail">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="Digite sua senha">
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmação de Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="Confirme sua senha">
            </div>
            <button type="submit" class="btn btn-primary w-100">Registrar</button>
        </form>
    </div>
</div>
@endsection