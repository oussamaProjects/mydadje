@extends('layouts.app')

@section('content')

    <section class="absolute w-full h-full">
        <div class="absolute top-0 w-full h-full bg-gray-900"
            style="background-image: url(./assets/img/register_bg_2.png); background-size: 100%; background-repeat: no-repeat;">
        </div>
        <div class="container mx-auto px-4 h-full">
            <div class="flex content-center items-center justify-center h-full">
                <div class="w-full lg:w-4/12 px-4">
                    <div
                        class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-md rounded-lg bg-gray-300 border-0">
                        <div class="rounded-t mb-0 px-6 py-6 hidden">
                            <div class="text-center mb-3">
                                <h6 class="text-gray-600 text-sm font-bold">
                                    Se connecter avec
                                </h6>
                            </div>
                            <div class="btn-wrapper text-center">
                                <button
                                    class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-2 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                                    type="button" style="transition: all 0.15s ease 0s;">
                                    <img alt="..." class="w-5 mr-1" src="./assets/img/github.svg">Github</button><button
                                    class="bg-white active:bg-gray-100 text-gray-800 font-normal px-4 py-2 rounded outline-none focus:outline-none mr-1 mb-1 uppercase shadow hover:shadow-md inline-flex items-center font-bold text-xs"
                                    type="button" style="transition: all 0.15s ease 0s;">
                                    <img alt="..." class="w-5 mr-1" src="./assets/img/google.svg">Google
                                </button>
                            </div>
                            <hr class="mt-6 border-b-1 border-gray-400">
                        </div>
                        <div class="flex-auto px-4 lg:px-10 py-8 pt-8">
                            <div class="text-gray-500 text-center mb-6 font-bold">
                                <small>Connectez-vous avec des informations d'identification</small>
                            </div>

                            <form action="{{ route('login') }}" method="POST">
                                {{ csrf_field() }}

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="email">Adresse
                                        e-mail</label>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                        autofocus
                                        class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Email" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('email'))
                                        <span class="text-red-600 text-xs">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>

                                <div class="relative w-full mb-3">
                                    <label class="block uppercase text-gray-700 text-xs font-bold mb-2" for="password">Mot
                                        de passe</label>
                                    <input id="password" type="password" name="password" required
                                        class="border-0 px-3 py-3 placeholder-gray-400 text-gray-700 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full"
                                        placeholder="Mot de passe" style="transition: all 0.15s ease 0s;">
                                    @if ($errors->has('password'))
                                        <span class="text-red-600 text-xs">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div>
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}
                                            class="form-checkbox border-0 rounded text-gray-800 ml-1 w-5 h-5"
                                            style="transition: all 0.15s ease 0s;">
                                        <span class="ml-2 text-sm font-semibold text-gray-700">Rester connecté</span>
                                    </label>
                                </div>
                                <div class="text-center mt-6">
                                    <button name="login"
                                        class="bg-gray-900 text-white active:bg-gray-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 w-full"
                                        type="submit" style="transition: all 0.15s ease 0s;">
                                        Connexion
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                    <div class="flex flex-wrap mt-6 relative">
                        <div class="w-1/2">
                            <a href="{{ route('password.request') }}" class="text-gray-300"><small>Mot de passe oublié
                                    ?</small></a>
                        </div>
                        <div class="w-1/2 text-right">
                            <a href="{{ route('register') }}" class="text-gray-300"><small>Créer un nouveau
                                    compte</small></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="absolute w-full bottom-0 bg-gray-900 pb-6">
            <div class="container mx-auto px-4">
                <hr class="mb-6 border-b-1 border-gray-700">
                <div class="flex flex-wrap items-center md:justify-between justify-center">
                    <div class="w-full md:w-4/12 px-4">
                        <div class="text-sm text-white font-semibold py-1">
                            Copyright © 2019
                            <a href="https://www.creative-tim.com"
                                class="text-white hover:text-gray-400 text-sm font-semibold py-1"> </a>
                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </section>

@endsection
