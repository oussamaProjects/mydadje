@extends('layouts.app')

@section('content')

    @include('inc.sidebar')


    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">
                                Modifier un dossier
                            </h3>
                        </div>

                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                            <button id="buttonmodal" data-target="modal1"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto"
                                type="button">Ajouter un dossiers</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
            <div class="col-span-2">

                <div class="flex items-center p-4 gap-4">
                    {!! Form::open(['action' => ['FolderController@update', $folder->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}


                    <div class="mb-4 relative">
                        {{ Form::text('name', $folder->name, ['class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent', 'id' => 'folder']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Nom de dossier
                        </label>
                    </div>
                    <div class="mb-4 relative">
                        <h3 class="text-gray-900 text-lg mt-6 mb-4 font-medium title-font uppercase">Permission</h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3">
                            @if (count($depts) > 0)
                                @foreach ($depts as $dept)

                                    <div class="mb-6">
                                        <div class="text-gray-900 mb-2 font-medium title-font">
                                            {{ $dept->dptName }} {{ $dept->permission_for }}
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                value="{{ $dept->id }}_all" id="{{ $dept->id }}_all"
                                                {{ $dept->permission_for == 0 && $dept->permission_for != '' ? 'checked' : '' }}>
                                            <label for="{{ $dept->id }}_all">All</label>
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                id="{{ $dept->id }}_admins" value="{{ $dept->id }}_admins"
                                                {{ $dept->permission_for == 1 || $dept->permission_for == '' ? 'checked' : '' }}>
                                            <label for="{{ $dept->id }}_admins">Admins</label>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>
                    {{ Form::submit('Sauvegarder les modifications', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded']) }}
                    {!! Form::close() !!}
                </div>
            </div>
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </div>







        <!-- Modal -->
        <div id="modal"
            class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
            <div
                class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl">
                <div id="closebutton"
                    class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
                    <p class="font-semibold text-gray-800">Ajouter un dossier</p>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                <div class="flex flex-col px-6 py-5 bg-gray-50">
                    {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => 'w-full']) !!}
                    <div class="mb-4 relative">
                        {{ Form::text('name', '', ['class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent', 'id' => 'category']) }}
                        <label for="email" class="text-xs opacity-75 scale-75">
                            Nom de dossier
                        </label>
                    </div>

                    <div class="mb-4 relative">
                        <h3 class="text-gray-900 text-lg mt-6 mb-4 font-medium title-font uppercase">Permission</h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3">
                            @if (count($depts) > 0)
                                @foreach ($depts as $dept)

                                    <div class="mb-6">
                                        <div class="text-gray-900 mb-2 font-medium title-font">
                                            {{ $dept->dptName }}
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                value="{{ $dept->id }}_all" id="{{ $dept->id }}_all"
                                                {{ $dept->permission_for == 0 ? 'checked' : '' }}>
                                            <label for="{{ $dept->id }}_all">All</label>
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                id="{{ $dept->id }}_admins" value="{{ $dept->id }}_admins"
                                                {{ $dept->permission_for == 1 ? 'checked' : '' }}>
                                            <label for="{{ $dept->id }}_admins">Admins</label>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{ Form::submit('Sauvegarder les modifications', ['class' => 'flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <script>
            const button = document.getElementById('buttonmodal')
            const closebutton = document.getElementById('closebutton')
            const modal = document.getElementById('modal')

            button.addEventListener('click', () => modal.classList.add('scale-100'))
            closebutton.addEventListener('click', () => modal.classList.remove('scale-100'))
        </script>

    @endsection
