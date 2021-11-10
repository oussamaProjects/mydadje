@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    {{-- <table class="bordered centered highlight responsive-table" id="myDataTable">
        <thead>
            <tr>
                <th>File Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Uploaded At</th>
                <th>Expires At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (count($docs) > 0)
                @foreach ($docs as $doc)
                    <tr>
                        <td>{{ $doc->name }}</td>
                        <td>{{ $doc->mimetype }}</td>
                        <td>{{ $doc->filesize }}</td>
                        <td>{{ $doc->created_at->toDayDateTimeString() }}</td>
                        <td>
                            @if ($doc->isExpire)
                                {{ $doc->expires_at }}
                            @else
                                No Expiration
                            @endif
                        </td>
                        <td>
                            @can('read')
                                {!! Form::open() !!}
                                <a href="documents/{{ $doc->id }}" class="tooltipped" data-position="left" data-delay="50"
                                    data-tooltip="View Details">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                {!! Form::close() !!}
                                {!! Form::open() !!}
                                <a href="documents/open/{{ $doc->id }}" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Open"><i class="material-icons">open_with</i></a>
                                {!! Form::close() !!}
                            @endcan
                            {!! Form::open() !!}
                            @can('download')
                                <a href="documents/download/{{ $doc->id }}" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Download"><i class="material-icons">file_download</i></a>
                            @endcan
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            @can('shared')
                                <a href="#" class="tooltipped" data-position="left" data-delay="50" data-tooltip="Share"><i
                                        class="material-icons">share</i></a>
                            @endcan
                            {!! Form::close() !!}
                            {!! Form::open() !!}
                            @can('edit')
                                <a href="documents/{{ $doc->id }}/edit" class="tooltipped" data-position="left"
                                    data-delay="50" data-tooltip="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                            @endcan
                            {!! Form::close() !!}
                            <!-- DELETE using link -->
                            {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                            @can('delete')
                                <a href="" class="data-delete tooltipped" data-position="left" data-delay="50"
                                    data-tooltip="Delete" data-form="documents-{{ $doc->id }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </a>
                            @endcan
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6">
                        <h5 class="teal-text">No Document has been uploaded</h5>
                    </td>
                </tr>
            @endif
        </tbody>
    </table> --}}

    <div class="ml-14 mt-16 mb-4 md:ml-64">
        <div class="flex items-center p-4 gap-4">

            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-sm mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}
                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="text" name="search" id="search" placeholder="Recherche"
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>

            <div class="flex ml-auto">
                <button
                    class="flex text-white bg-gray-900 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded ml-auto mr-4"
                    data-url="{{ url('documentsDeleteMulti') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>

                    <span class="ml-2">Supprimer la selection</span>

                </button>
                &nbsp;
                @can('upload')
                    <a href="/documents/create"
                        class="flex text-white bg-gray-900 border-0 py-2 px-4 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        <span class="ml-2">Ajouter un document</span>
                    </a>
                @endcan
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="flex flex-col text-center w-full mb-6">
                <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Mes documents</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Tous mes documents
                </p>
            </div>
            <div class="w-full">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th
                                class="w-10 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tr rounded-br">
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Nom de fichier
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Propriétaire
                            </th>
                            {{-- <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                            Département
                        </th> --}}
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Téléchargé à
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Expire le
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
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
                                    {{-- <td class="px-4 py-3 text-sm">{{ $doc->user->department['dptName'] }}</td> --}}
                                    <td class="px-4 py-3 text-sm">{{ $doc->created_at->toDayDateTimeString() }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        @if ($doc->isExpire)
                                            {{ $doc->expires_at }}
                                        @else
                                            No Expiration
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-900">
                                        <div class="h-6 flex ">
                                            @can('read')
                                                {!! Form::open() !!}
                                                <a href="/documents/{{ $doc->id }}" class="mr-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                                {!! Form::open() !!}
                                                <a href="/documents/open/{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('download')
                                                <a href="/documents/download/{{ $doc->id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                    </svg>
                                                </a>

                                                {!! Form::close() !!}
                                            @endcan
                                            @can('edit')
                                                <a href="/documents/{{ $doc->id }}/edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </a>
                                                {!! Form::close() !!}
                                            @endcan
                                        </div>
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

@endsection
