@extends('layouts.app')
@section('title') AgroShop @endsection

<head>
    <!-- Пакет JavaScript с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>
    <!-- Только CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<section style="background-color: #eee; border-radius: 50px">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Пользватель</a></li>
                        <li class="breadcrumb-item active text-success" aria-current="page">{{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if(Auth::user()->farmer == true)
                            <img src="https://www.kindpng.com/picc/m/123-1237758_farmer-emoji-png-transparent-png.png" alt="avatar"
                                 class="rounded-circle img-fluid center py-3" style="width: 150px;">
                        @elseif(Auth::user()->farmer == false)
                            <img src="https://www.clipartkey.com/mpngs/m/274-2740144_-man-in-tuxedo-emoji-boy-emoji.png" alt="avatar"
                                 class="rounded-circle img-fluid center" style="width: 150px;">
                        @endif

                        <h5 class="my-3">{{ $user->name }}</h5>
                            @if(Auth::user()->farmer == true)
                                <p class="text-muted mb-1">Фермер</p>
                            @elseif(Auth::user()->farmer == false)
                                <p class="text-muted mb-1">Продавец</p>
                            @endif

                        <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                        <div class="d-flex justify-content-center mb-2">
                            <div class="card-body p-0">
                                <ul class="list-group list-group-flush rounded-3">
                                    <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                        <i class="fas fa-globe fa-lg text-warning">Язык </i>
                                        <select name="brandFilter" class="form-select ml-5" aria-label="Default select example">
                                            <option>Казахский</option>
                                            <option>Руский</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <i class="fas fa-globe fa-lg text-warning">Дата регестрации: </i>
                                <p class="mb-0">{{$user->created_at}}</p>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-lg-8">
                <form action="{{route('editProfile')}}" method="POST">
                    @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Имя</p>
                            </div>
                            <div class="col-sm-9">
                                    <div class="form-group">
                                        <input name="name" class="form-control w-50" value="{{ $user->name }}">
                                    </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <input name="email" id="email" class="form-control w-50" value="{{ $user->email }}">

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Номер телефона</p>
                            </div>
                            <div class="col-sm-9">
                                <input name="phoneNumber" disabled id="phoneNumber" class="form-control w-50" value="{{ $user->phoneNumber }}">

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Тип аккаунта</p>
                            </div>
                            <div class="col-sm-9">
                                @if(Auth::user()->farmer == true)
                                    <p class="text-muted mb-1">Фермер</p>
                                @elseif(Auth::user()->farmer == false)
                                    <p class="text-muted mb-1">Продавец</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Адресс</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    <?php

                                    use App\Models\User;Illuminate\Support\Facades\DB::table("users")->join('countries', function ($join) {
                                        $join->on('users.country_id', '=', 'countries.id');
                                    });

                                    ?>
                                    @if($user->country_id == 1)
                                        Казахстан
                                        @elseif($user->country_id == 2)
                                        Россия
                                        @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                    <button class="btn btn-warning">Сохранить</button>
                </form>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body shadow-3">
                                <h6>Адреса</h6>
                            </div>
                            <div class="card-body">
                                <script>
                                    function disp(form) {
                                        if (form.style.display == "none") {
                                            form.style.display = "block";
                                        } else {
                                            form.style.display = "none";
                                        }
                                    }
                                </script>
                                <button style="background-color: #FFC528; width: 380px" class="btn btn-outline btn-sm" type="button"
                                        value="Добавить адресс" onclick="disp(document.getElementById('form1'))">
                                    Добавить адресс
                                </button>
                                <form method="POST" action="{{route('profile')}}" id="form1" style="display: none;">

                                    <h6 class="mb-0 mt-3">Область</h6>
                                    <div class="btn-group mt-2">
                                        <button type="button" class="btn border btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Алматинская область
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Астана</a>
                                        </div>
                                    </div>

                                    <h6 class="mb-0 mt-3">Район</h6>
                                    <div class="btn-group mt-2">
                                        <button type="button" class="btn border btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Балхаш район
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Астана</a>
                                        </div>
                                    </div>

                                    <h6 class="mb-0 mt-3">Адрес</h6>
                                    <input class="form-control mt-2">

                                    <h5 class="mb-0 mt-3">Коментарий</h5>
                                    <input class="form-control mt-2">

                                    <button class="btn btn-outline-primary mt-3" type="submit">Сохранить</button>

                                </form>




                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 mb-md-0">
                            <div class="card-body shadow-3">
                                <h6>Культуры</h6>
                            </div>
                            <div class="card-body">
                                <script>
                                    function kult(form) {
                                        if (form.style.display == "none") {
                                            form.style.display = "block";
                                        } else {
                                            form.style.display = "none";
                                        }
                                    }
                                </script>
                                <button style="background-color: #FFC528; width: 380px" class="btn btn-outline btn-sm" type="button"
                                        value="Добавить адресс" onclick="kult(document.getElementById('culture'))">
                                    Добавить Культуру
                                </button>
                                <form id="culture" style="display: none;">

                                    <h6 class="mb-0 mt-3">Культура</h6>
                                    <div class="btn-group mt-2">
                                        <button type="button" class="btn border btn-outline dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Пшеница
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Астана</a>
                                        </div>
                                    </div>
                                    <h5 class="mb-0 mt-3">Площадь</h5>
                                    <input class="form-control mt-2">

                                    <button class="btn btn-outline-primary mt-3" type="submit">Сохранить</button>


                                </form>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
