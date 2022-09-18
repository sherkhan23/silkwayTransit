@extends('layouts.app')
@include("inc.header")
<div class="container-fluid pb-3 mt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-dark rounded-3 shadow" style="border: 1px black solid">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <svg class="bi pe-none me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
                    <span class="fs-4">Sidebar</span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">

                    <div class="nav nav-tabs d-block ml-3 flex-column" id="nav-tab" role="tablist">

                        <li>
                            @if(Auth::user()->role == 'admin')
                                <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit"  class="nav-link active w-100 text-white" id="createOrder" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                                    Создать заказ
                                </button>
                            @elseif(Auth::user()->role != 'admin')
                                <p></p>
                            @else

                            @endif

                        </li>

                        <li>
                            <button class="nav-link w-100 text-dark" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                        </li>
                        <li>
                            <button class="nav-link w-100 text-dark" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>

                        </li>
                        <li>
                            <a href="#" class="nav-link text-dark">
                                <svg class="bi pe-none me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
                                Customers
                            </a>
                        </li>
                    </div>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                        <strong>mdo</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-9 bg-light rounded-3">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="createOrder">

                    <form action="{{route('order_process')}}" method="POST" class="form-control bg-light">
                    @csrf <!-- {{ csrf_field() }} -->

                            <p class="text-muted">Локоматив</p>
                            <select name="locomative" class="form-select w-25" aria-label="Default select example">
                                @foreach($locomative as $locomat)
                                    <option value="{{$locomat->id}}">{{$locomat->locomativeNum  }}</option>
                                @endforeach
                            </select>

                        <p class="text-muted">Локоматив</p>

                        <div style="display: inline-flex; position: relative">
                                <div>
                                    Водитель 1
                                    <select name="driver1" class="form-select" aria-label="Default select example">
                                        @foreach($users as $user)
                                            <option value="{{$user->name}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                               <div id="form1" style="display: none; margin-left: 20px">
                                   Водитель 2
                                   <select  name="driver2" class="form-select" aria-label="Default select example">
                                       @foreach($users as $user)
                                           <option value="{{$user->name}}">{{$user->name}}</option>
                                       @endforeach
                                   </select>
                               </div>


                            <div class="ml-3 pt-4"><button class="btn btn-outline-primary" type="button" onclick="hide(document.getElementById('form1'))">+</button>

                        </div>
                        </div>


                        <div class="row">

                            <div class="col-md-2">
                                <p class="text-muted mt-3">Станция` 1</p>
                                <select name="station1_id" class="form-select" aria-label="Default select example">
                                    @foreach($stations as $station)
                                        <option value="{{$station->id}}">{{$station->stationName  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <p class="text-muted mt-3">Станция 2</p>
                                <select name="station2_id" class="form-select" aria-label="Default select example">
                                    @foreach($stations as $station)
                                        <option value="{{$station->id  }}">{{$station->stationName  }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3" style="display: none" id="dep3">
                                <p class="text-muted mt-3">Станция 3</p>
                                <select class="form-select" aria-label="Default select example">
                                    @foreach($stations as $station)
                                        <option value="{{$station->id  }}">{{$station->stationName  }}</option>
                                    @endforeach
                                </select>
                            </div>

                                <div class="col-md-1">
                                    <p class="mt-3">Добавить</p>
                                    <div class="ml-3"><button class="btn btn-outline-primary" type="button" onclick="hide(document.getElementById('dep3'))">+</button></div>
                                </div>

                        </div>


                        <div class="row mt-3">

                            <div class="col-md-3">
                                Выход от станции 1
                               <input name="st1deportTime" type="datetime-local" class="form-control">
                            </div>

                            <div class="col-md-3">
                                Время приезда в станицю 2
                                <input name="st2arriveTime" type="datetime-local" class="form-control">
                            </div>

                        </div>

                        <button type="submit" class="form-control btn btn-primary mt-3 w-50">Передать</button>
                    </form>

                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
            </div>

        </div>
    </div>
</div>

<script>
    function hide(form) {
        if (form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
    }
</script>
