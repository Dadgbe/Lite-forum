<header class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Lyam forum - Дискуссионный форум</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth <!-- Если пользователь авторизован -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('personal_cabinet') }}">Личный кабинет</a>
                    </li>
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Выйти</button>
                        </form>
                    </li>
                @else <!-- Если пользователь не авторизован -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</header>
