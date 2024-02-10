<!DOCTYPE html>
<html>
<head>
    <style>
        /* Стили для письма */
    </style>
</head>
<body>
    <header>
        <img src="{{ asset('images/logo.png') }}" alt="Логотип">
    </header>

    <main>
        <h1>Поздравляем, {{ $user->name }}!</h1>
        <p>Вы успешно зарегистрировались!</p>

        <p>Данные для входа в учетную запись:</p>
        <ul>
            <li>Логин: {{ $user->email }}</li>
            <li>Пароль: {{ $password }}</li>
        </ul>

        <p><a href="http://127.0.0.1:8000/login">Войти в учетную запись</a></p>
    </main>
</body>
</html>
