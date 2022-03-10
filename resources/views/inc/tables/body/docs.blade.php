<tr id="tr_{{ $current_doc->id }}" class="text-gray-800 border-b hover:bg-bg-color transition">
    {{-- <td>
       <input type="checkbox" id="chk_{{ $current_doc->id }}" class="sub_chk" data-id="{{ $current_doc->id }}"><label for="chk_{{ $current_doc->id }}"></label> 
    </td> --}}
    <td class="px-2 py-3 text-sm">{{ $current_doc->name }} V-{{ $current_doc->version }}</td>
    <td class="px-2 py-3 text-sm">{{ $current_doc->user->name ?? '' }}</td>
    <td class="px-2 py-3 text-sm">{{ $current_doc->filesize }}</td>
    <td class="px-2 py-3 text-sm">
        @include('inc.mime-type', ['doc'=>$doc])
    </td>
    {{-- <td class="px-2 py-3 text-sm">
        {{ \Carbon\Carbon::createFromTimeStamp($current_doc->created_at->toDayDateTimeString())->formatLocalized('%d %B %Y, %H:%M') }}
    </td> --}}
    <td class="px-2 py-3 text-sm">
        {{ \Carbon\Carbon::createFromTimeStamp(Storage::lastModified($current_doc->file))->formatLocalized('%d %B %Y, %H:%M') }}
    </td>
    <td class="px-2 py-3 text-sm">
        {{-- @if ($current_doc->isExpire)  {{ $current_doc->expires_at }} @else No Expiration @endif --}}
    </td>
    <td class="px-2 py-3 text-sm">
        @foreach ($current_doc->department()->get() as $department)
            @if (isset($department->pivot->permission_for) && ($department->pivot->permission_for == 1 || $department->pivot->permission_for == 0))
                <span class="text-xs leading-5 text-bg-color bg-secondary px-2 rounded ml-1 mb-1 inline-block ">
                    {{ $department->dptName }}
                </span>
            @endif
        @endforeach
    </td>
    <td class="px-2 py-3 text-sm">
        @foreach ($current_doc->department()->get() as $department)
            @if (isset($department->pivot->permission_for) && $department->pivot->permission_for == 0)
                <span class="text-xs leading-5 text-bg-color bg-secondary px-2 rounded ml-1 mb-1 inline-block ">
                    {{ $department->dptName }}
                </span>
            @endif
        @endforeach
    </td>
    <td class="px-2 py-3 text-sm">
        <div class="h-6 flex ">

            {!! Form::open() !!}
            <a href="/documents/{{ $current_doc->id }}" class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                </svg>
            </a>
            {!! Form::close() !!}
            @hasanyrole('Root|Admin')
                @can('read')
                    {!! Form::open() !!}
                    <a href="/documents/open/{{ $current_doc->id }}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>
                    {!! Form::close() !!}
                @endcan
                @can('download')
                    <a href="/documents/download/{{ $current_doc->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                    </a>
                @endcan
                <!-- SHARE using link -->
                @can('shared')
                    {!! Form::open(['action' => ['ShareController@update', $current_doc->id], 'method' => 'PATCH', 'id' => 'form-share-documents-' . $current_doc->id]) !!}
                    <a href="" class="data-share" data-form="documents-{{ $current_doc->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </a>

                    {!! Form::close() !!}
                @endcan
                @can('edit')
                    <a href="/documents/{{ $current_doc->id }}/edit" class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </a>
                @endcan
                <!-- DELETE using link -->
                @can('delete')
                    {!! Form::open(['action' => ['DocumentsController@destroy', $current_doc->id], 'method' => 'DELETE', 'id' => 'form-delete-documents-' . $current_doc->id]) !!}
                    <a href="" class="data-delete" data-form="documents-{{ $current_doc->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </a>
                    {!! Form::close() !!}
                @endcan
            @endhasanyrole

            <a href="/favorites/document/{{ $current_doc->id }}/">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-red-500"
                    fill="{{ $current_doc->hasBeenFavoritedBy(auth()->user()) ? 'red' : 'none' }}"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
            </a>

        </div>
    </td>
</tr>
