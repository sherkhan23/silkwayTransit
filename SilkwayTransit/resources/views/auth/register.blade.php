@extends('layouts.app')

<div class="modal modal-signin position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSignin">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <!-- <h5 class="modal-title">Modal title</h5> -->
                <h2 class="fw-bold mb-0">Регистрация</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5 pt-0">
                <form action="{{ route("register_process") }}" class="space-y-5" method="POST">
                    @csrf

                    <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 " placeholder="Введите имя" />

                    @error('name')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <input id="phoneNumber" name="phoneNumber" type="text" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Введите номер" />

                    @error('phoneNumber')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <select name="role" class="form-select" aria-label="Роль">
                        <option value="admin">Админ</option>
                        <option value="driver">Машинист</option>
                        <option value="duty">Дежурный по ДЕПО</option>
                    </select>


                    <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 " placeholder="Пароль" />

                    @error('password')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3" placeholder="Подтверждение пароля" />

                    @error('password_confirmation')
                    <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div>
                        <a href="{{ route("login") }}" class="font-medium text-secondary rounded-md p-2">Есть аккаунт?</a>
                    </div>

                    <button type="submit" class="btn btn-outline-primary text-center w-full py-3 font-medium" style="font-size: 20px">Регистрация</button>
                </form>
            </div>
        </div>
    </div>
</div>
