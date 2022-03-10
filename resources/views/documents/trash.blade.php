@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="flex items-end p-4 gap-1">
        @can('upload')
            <a href="/documents/create"
                class="flex text-bg-color bg-secondary border py-2 px-6 text-tiny focus:outline-none hover:bg-main ml-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>
                <span class="ml-2">Ajouter un document</span>
            </a>
        @endcan
    </div>

    <div class="grid grid-cols-1 pb-4 px-3 mx-4 bg-white shadow-sm">
        <div class="flex flex-col text-center w-full px-2 pb-2 bg-white">
            <h1 class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">Documents</h1>
            <p class="lg:w-2/3 mx-auto leading-relaxed text-base">{{ count($trash) }} à été supprimer
            </p>
        </div>
        <div class="w-full">
            <table class="table-auto w-full text-left bg-colorspace-no-wrap border bg-white px-2">
                <thead>
                    <tr>
                        <th
                            class="w-10 px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                        </th>
                        <th
                            class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                            Nom du document
                        </th>
                        <th
                            class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                            Propriétaire
                        </th>
                        {{-- <th class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                                    Département
                                </th> --}}
                        <th
                            class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                            Date Insertion
                        </th>
                        <th
                            class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                            Expire le
                        </th>
                        <th
                            class="px-2 py-2 title-font tracking-wider font-medium text-bg-color text-base bg-main shadow-sm">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($trash) > 0)
                        @foreach ($trash as $tra)
                            @foreach ($tra as $t)
                                <tr id="tr_{{ $t->id }}" class="border-b">
                                    <td>
                                        <input type="checkbox" id="chk_{{ $t->id }}" class="sub_chk"
                                            data-id="{{ $t->id }}">
                                        <label for="chk_{{ $t->id }}"></label>
                                    </td>
                                    <td class="px-2 py-3 text-sm">{{ $t->name }}</td>
                                    <td class="px-2 py-3 text-sm">{{ $t->user->name }}</td>
                                    {{-- <td class="px-2 py-3 text-sm">{{ $t->user->department['dptName'] }}</td> --}}
                                    <td class="px-2 py-3 text-sm">
                                        {{ \Carbon\Carbon::createFromTimeStamp($t->created_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}
                                    </td>
                                    <td class="px-2 py-3 text-sm">
                                        @if ($t->isExpire)
                                            {{ $t->expires_at }}
                                        @else
                                            No Expiration
                                        @endif
                                    </td>
                                    <td class="px-8 py-3 text-lg text-gray-800">
                                        <div class="h-6 flex ">

                                            {!! Form::open() !!}
                                            <a href="/documents/{{ $t->id }}" class="mr-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                                                </svg>
                                            </a>
                                            {!! Form::close() !!}

                                            @hasanyrole('Root|Admin')
                                                @can('read')
                                                    {!! Form::open() !!}
                                                    <a href="/documents/open/{{ $t->id }}" target="_blank">
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
                                                    <a href="/documents/download/{{ $t->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                <!-- SHARE using link -->
                                                @can('shared')
                                                    {!! Form::open(['action' => ['ShareController@update', $t->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $t->id]) !!}
                                                    <a href="" class="data-share" data-form="documents-{{ $t->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                        </svg>
                                                    </a>

                                                    {!! Form::close() !!}
                                                @endcan
                                                @can('edit')
                                                    <a href="/documents/{{ $t->id }}/edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                @endcan
                                                <!-- DELETE using link -->
                                                @can('delete')
                                                    {!! Form::open(['action' => ['DocumentsController@destroy', $t->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $t->id]) !!}
                                                    <a href="" class="data-delete" data-form="documents-{{ $t->id }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                    {!! Form::close() !!}
                                                @endcan
                                            @endhasanyrole
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">
                                <h5 class="p-6 text-center">Aucun document n'a été téléchargé</h5>
                            </td>
                        </tr>
                    @endif


                </tbody>
            </table>
        </div>
    </div>

    @include('inc.sidebar-footer')

@endsection
