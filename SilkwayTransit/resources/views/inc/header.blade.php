@extends('layouts.app')
<header class="p-3 text-dark bg-light">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <span class="fs-4 text-dark">Silkway Transit</span>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 ml-5">
                <li><a href="#" class="nav-link px-2 text-dark">Главная</a></li>
                <li><a href="#" class="nav-link px-2 text-dark">Features</a></li>
                <li><a href="#" class="nav-link px-2 text-dark">О нас</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
            </form>
            @guest("web")
            <div class="text-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Логин
                    </button>
                    <div class="dropdown-menu">

                        <div class="dropdown-divider"></div>
                        <li><a class="dropdown-item" href="{{route('login')}}">Логин</a></li>
                        <li><a class="dropdown-item" href="{{route('register')}}">Регистрация</a></li>
                    </div>
                </div>
            </div>
                @endguest

                @auth("web")
                <div class="text-end">
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right: 10px">
                            {{ Auth::user()->name }}
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('login')}}">{{Auth::user()->role}}</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('logout')}}">Профиль</a>
                            <a class="dropdown-item" href="{{route('logout')}}">Выйти</a>
                        </div>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
</header>
