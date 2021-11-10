@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64 p-4">

        <div class="grid grid-cols-1 lg:grid-cols-1">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-2xl text-gray-900 capitalize">
                                {{ isset($folder) ? $folder->name : 'Root' }}
                            </h3>
                        </div>
                        <div class="flex ml-auto relative text-right">
                            <a href="\allFolders"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">Afficher
                                tous les dossiers</a>
                            <button id="buttonmodal"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-4"
                                type="button">Ajouter un dossiers</button>
                            @can('upload')
                                <button id="buttonmodalFile"
                                    class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-4"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    <span class="ml-2">Ajouter un document</span>
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="grid grid-cols-6 lg:grid-cols-6 p-4 mb-6 mt-6 gap-4 bg-gray-50 shadow">

            @if (count($folders_table) > 0)
                @foreach ($folders_table as $folder)
                    <div id="tr_{{ $folder->id }}">

                        <div data-id="{{ $folder->id }}"
                            class="max-w-xs mx-auto overflow-hidden bg-red-100 shadow relative">

                            {{-- <input type="checkbox" class="filled-in sub_chk absolute m-4" id="chk_{{ $folder->id }}" data-id="{{ $folder->id }}"> --}}
                            {{-- <label for="chk_{{ $folder->id }}"></label> --}}

                            {{-- <img class="object-cover w-full h-56"
                                        src="https://images.unsplash.com/photo-1542156822-6924d1a71ace?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=60"
                                        alt="avatar"> --}}

                            <div class="flex py-4 px-2 text-center align-middle">
                                <div class="image">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto my-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col name px-3 text-left">

                                    <a href="/folder/{{ $folder->id }}/child"
                                        class="block text-md font-bold text-gray-800 capitalize">
                                        {{ $folder->name }}
                                    </a>
                                    <div class="text-xs mt-auto">
                                        {{ $folder->created_at->toDayDateTimeString() }}
                                    </div>
                                </div>
                                <!-- DELETE using link -->
                                {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center flex-col actions ml-auto -my-4']) !!}
                                <a href="/folder/{{ $folder->id }}/child">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                    </svg>
                                </a>
                                <a href="#" class="left"><i class="material-icons"></i></a>
                                <a href="/folders/{{ $folder->id }}/edit" class="center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <a href="" class="right data-delete" data-form="folders-{{ $folder->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-span-6 lg:col-span-8">
                    <h5 class="text-center p-4">Aucun dossier n'a été crée</h5>
                </div>
            @endif
        </div>

        @hasanyrole('Root|Admin')

        <div class="grid grid-cols-4 lg:grid-cols-4 ">
            <div class="col-span-4">
                <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words w-full">
                    <div class="rounded-t mb-0 px-0 border-0">
                        <div class="flex flex-col text-center w-full mb-6">
                            <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Dossiers</h1>
                            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous les dossiers</p>
                        </div>
                        <div class="block w-full overflow-x-auto">
                            <table class="items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-4 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        </th>
                                        <th
                                            class="px-4 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Nom du dossier
                                        </th>
                                        <th
                                            class="px-4 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                            Permission
                                        </th>
                                        <th
                                            class="px-4 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($folders_table) > 0)
                                        @foreach ($folders_table as $folder)
                                            <tr id="tr_{{ $folder->id }}" class="text-gray-700 ">
                                                <th
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-2 text-left">
                                                    <input type="checkbox" id="chk_{{ $folder->id }}" class="sub_chk"
                                                        data-id="{{ $folder->id }}">
                                                    <label for="chk_{{ $folder->id }}"></label>
                                                </th>
                                                <td
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-2">
                                                    {{ $folder->name }}
                                                </td>

                                                <td
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-2">

                                                    @foreach ($folder->department()->get() as $department)
                                                        <div class="ml-auto text-gray-900 text-xs leading-5">
                                                            <strong>{{ $department->dptName }}</strong>
                                                            @if (isset($department->pivot->permission_for))
                                                                -
                                                                {{ $department->pivot->permission_for == 0 ? 'Tous' : ' Admins' }}

                                                            @else
                                                                -
                                                                {{ 'All' }}
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </td>

                                                <td
                                                    class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-2">


                                                    <!-- DELETE using link -->
                                                    {!! Form::open(['action' => ['FolderController@destroy', $folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $folder->id, 'class' => 'flex items-center']) !!}
                                                    <a href="\folders\{{ $folder->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                    <a href="#" class="left"><i class="material-icons"></i></a>
                                                    <a href="/folders/{{ $folder->id }}/edit" class="center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <a href="" class="right data-delete"
                                                        data-form="folders-{{ $folder->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                    {!! Form::close() !!}

                                                </td>

                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4">
                                                <h5 class="teal-text text-center p-4">Aucune dossier n'a été crée</h5>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endhasanyrole
    </div>



    @include('popups.addFolder')
    @include('popups.addDossier')
    @include('popups.addCategorie')
    @include('popups.scripts')


@endsection
