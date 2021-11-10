@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-10 md:ml-64">

        <div class="flex items-center p-4 font-bold text-lg">

            @if ($previous)
                <a href="{{ URL::to('documents/' . $previous) }}" class="flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </a>
            @endif

            @if ($next)
                <a href="{{ URL::to('documents/' . $next) }}" class="ml-auto flex items-center justify-center">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            @endif

        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">

            @if ($doc->isExpire == 2)
                <h5 class="text-red-600 text-xs">
                    <i class="material-icons">error_outline</i> This Document Has Expired!
                </h5>
                <p class="text-red-600 text-xs">Please consider disposal or restoration of this document.</p>
            @endif

            <section class="text-gray-600 body-font overflow-hidden">
                <div class="container px-5 py-24 mx-auto">
                    <div class="lg:w-4/5 mx-auto flex flex-wrap">
                        <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0 relative">
                            <h1 class="text-gray-900 text-3xl title-font font-medium mb-4">Document Information</h1>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Document Name</span>
                                <span class="ml-auto text-gray-900">{{ $doc->name }}</span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Description</span>
                                <span class="ml-auto text-gray-900">{{ $doc->description }}</span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Owner</span>
                                <span class="ml-auto text-gray-900">{{ $doc->user['name'] }}</span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Department</span>
                                <span class="ml-auto text-gray-900">{{ $doc->user->department['dptName'] }}</span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Category</span>
                                <div class="flex flex-col ml-auto ">
                                    @foreach ($doc->categories()->get() as $cate)
                                        <span class="ml-auto text-gray-900">{{ $cate->name }} </span><br />
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Folder</span>
                                <div class="flex flex-col ml-auto ">
                                    @foreach ($doc->folders()->get() as $folder)
                                        <span class="ml-auto text-gray-900">{{ $folder->name }} </span><br />
                                    @endforeach
                                </div>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Expires At</span>
                                <span class="ml-auto text-gray-900">
                                    @if ($doc->isExpire)
                                        {{ $doc->expires_at }}
                                    @else
                                        No Expiration is set
                                    @endif
                                </span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Uploaded At</span>
                                <span class="ml-auto text-gray-900">{{ $doc->created_at->toDayDateTimeString() }} </span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">Updated At</span>
                                <span class="ml-auto text-gray-900">{{ $doc->updated_at->toDayDateTimeString() }} </span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <span class="text-gray-500">MetaData</span>
                                <span class="ml-auto text-right text-gray-900">
                                    Size : {{ $doc->filesize }} <br />
                                    Type : {{ $doc->mimetype }}<br />
                                    Last Modified :
                                    {{ \Carbon\Carbon::createFromTimeStamp(Storage::lastModified($doc->file))->formatLocalized('%d %B %Y, %H:%M') }}
                                </span>
                            </div>

                            <div class="flex border-t border-gray-200 py-2 text-xs">
                                <div class="text-gray-500">Permission</div>
                                <div class="ml-auto text-right text-gray-900">


                                    @foreach ($doc->department()->get() as $department)
                                        <div class="ml-auto text-gray-900">
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
                                </div>
                            </div>


                            <div class="flex mt-6">

                                <a href="/documents"
                                    class="mr-auto flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                                    </svg>
                                    Retour en arrière
                                </a>

                                {!! Form::open() !!}
                                @can('edit')
                                    <a href="/documents/{{ $doc->id }}/edit"
                                        class="ml-auto rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4"
                                        data-position="left" data-delay="50" data-tooltip="Edit this">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                @endcan
                                <a href="/documents/open/{{ $doc->id }}"
                                    class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4"
                                    data-position="top" data-delay="50" data-tooltip="Open this">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                {!! Form::close() !!}
                                <!-- SHARE using link -->
                                {!! Form::open(['action' => ['ShareController@update', $doc->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $doc->id]) !!}
                                @can('shared')
                                    <a href="#"
                                        class="data-share rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4"
                                        data-position="top" data-delay="50" data-tooltip="Share this"
                                        data-form="documents-{{ $doc->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                    </a>
                                @endcan
                                {!! Form::close() !!}
                                <!-- DELETE using link -->
                                {!! Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $doc->id]) !!}
                                @can('delete')
                                    <a href="#"
                                        class="rounded-full w-10 h-10 bg-gray-200 p-0 border-0 inline-flex items-center justify-center text-gray-500 ml-4"
                                        data-position="right" data-delay="50" data-tooltip="Delete this"
                                        data-form="documents-{{ $doc->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </a>
                                @endcan
                                {!! Form::close() !!}
                            </div>

                        </div>
                        <div class="lg:w-1/2 w-full lg:pr-10 lg:py-6 mb-6 lg:mb-0 relative">
                            @if ($doc->mimetype == 'application/pdf')
                                <embed src="{{ $path }}" type="application/pdf" class="w-full h-full">
                            @elseif ($doc->mimetype ==
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
                                <iframe
                                    src="https://docs.google.com/gview?url=http://ieee802.org/secmail/docIZSEwEqHFr.doc&embedded=true"
                                    frameborder="0" class="w-full h-full">
                                </iframe>
                            @else
                                <img alt="" src="{{ $path }}" class="w-full h-full">
                            @endif

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

@endsection
