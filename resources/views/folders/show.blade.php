@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-10 md:ml-64">
        <!-- Statistics Cards -->
        <div class="flex p-4 gap-4">

            <button id="buttonmodal"
                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
                Ajouter un dossiers
            </button>

            @can('upload')
            @endcan

        </div>

        <div class="my-1 px-4 ">
            <h6 class="text-gray-900 text-5xl font-semibold capitalize text-center ">
                {{ $folder->name }}
            </h6>
        </div>

        @if (count($folders) > 0)

            <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-6 p-4 gap-4">
                @foreach ($folders as $folder)
                    <div id="tr_{{ $folder->id }}" class="overflow-hidden bg-white shadow-md px-4 py-4   relative">
                        <div class="" data-id="{{ $folder->id }}">
                            <a href="/folders/{{ $folder->id }}">
                                <div class="center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto my-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                    </svg>
                                    <h6 class="text-gray-900 text-lg mb-1 font-medium title-font text-center capitalize">
                                        {{ $folder->name }}
                                    </h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="min-w-0 mb-4 lg:mb-0 break-words pt-8 w-full rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-col text-center w-full mb-6">
                        <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Documents</h1>
                    </div>
                    <div class="block w-full overflow-x-auto shadow">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Nom de fichier
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Propriétaire
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Département
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Téléchargé à
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Expiré le
                                    </th>
                                    <th
                                        class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>


                                @if (count($docs) > 0)
                                    @foreach ($docs as $doc)
                                        <tr id="tr_{{ $doc->id }}">
                                            <td>
                                                <input type="checkbox" id="chk_{{ $doc->id }}" class="sub_chk"
                                                    data-id="{{ $doc->id }}">
                                                <label for="chk_{{ $doc->id }}"></label>
                                            </td>
                                            <td class="px-4 py-3 text-sm">{{ $doc->name }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $doc->user->name }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $doc->user->department['dptName'] }}</td>
                                            <td class="px-4 py-3 text-sm">{{ $doc->created_at->toDayDateTimeString() }}
                                            </td>
                                            <td class="px-4 py-3 text-sm">
                                                @if ($doc->isExpire)
                                                    {{ $doc->expires_at }}
                                                @else
                                                    No Expiration
                                                @endif
                                            </td>
                                            <td class="flex items-center px-4 py-3 text-sm flex">
                                                @can('read')
                                                    {!! Form::open() !!}
                                                    <a href="/documents/{{ $doc->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                        </svg>
                                                    </a>
                                                    {!! Form::close() !!}
                                                    {!! Form::open() !!}
                                                    <a href="/documents/open/{{ $doc->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                    {!! Form::close() !!}
                                                @endcan
                                                @can('download')
                                                    <a href="/documents/download/{{ $doc->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                <!-- SHARE using link -->
                                                @can('shared')
                                                    {!! Form::open(['action' => ['ShareController@update', $doc->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $doc->id]) !!}
                                                    <a href="" class="data-share" data-form="documents-{{ $doc->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                        </svg>
                                                    </a>

                                                    {!! Form::close() !!}
                                                @endcan
                                                @can('edit')
                                                    <a href="/documents/{{ $doc->id }}/edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                <!-- DELETE using link -->
                                                @can('delete')
                                                    {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                                                    <a href="" class="data-delete" data-form="documents-{{ $doc->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                    {!! Form::close() !!}
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">
                                            <h5 class="p-6 text-center">Aucun document n'a été téléchargé</h5>
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

    <div id="modal"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal content -->
        <div class="bg-white w-1/2 p-4">
            <!--Close modal button-->
            <button id="closebutton" type="button" class="focus:outline-none float-right">
                <!-- Hero icon - close button -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>

            <!-- Test content -->
            <div>
                <h2 class="text-gray-900 text-xl mb-2 font-medium title-font">Ajouter le dossier</h2>

                {!! Form::open(['action' => 'FolderController@store', 'method' => 'POST', 'class' => '']) !!}

                <div class="mb-4 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">Nom
                        de dossier</label>
                    {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                </div>

                <div class="mb-4 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">Dans
                        le dossier</label>
                    <div class="relative inline-block w-full text-gray-700">
                        {{ Form::select('folder_parent_id[]', $folders_input, $folders_input, ['id' => 'folder', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent placeholder-gray-600 border appearance-none focus:shadow-outline']) }}
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" fill-rule="evenodd">
                                </path>
                            </svg>
                        </div>
                    </div>
                    @if ($errors->has('folder'))
                        <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                    @endif
                </div>

            </div>

            <div class="flex">
                {{ Form::submit('Envoyer', ['class' => 'focus:outline-none py-2 px-4 bg-gray-900 text-white bg-opacity-75 ml-auto']) }}
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
