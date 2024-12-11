<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuário</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuário</h2>
        <form action="{{ route('register.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-control" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmação de Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Registrar</button>
        </form>
    </div>
</body>
</html>
