<tr id="tr_{{ $current_folder->id }}" class="text-gray-800 border-b hover:bg-bg-color transition">
    <td>
        {{-- <input type="checkbox" id="chk_{{ $current_folder->id }}" class="sub_chk" data-id="{{ $current_folder->id }}"><label for="chk_{{ $current_folder->id }}"></label> --}}
    </td>
    <td class="px-2 py-3 text-sm">
        {{ $current_folder->name }}
    </td>

    <td class="px-2 py-3 text-sm">
        @foreach ($current_folder->department()->get() as $department)
            @if (isset($department->pivot->permission_for) && ($department->pivot->permission_for == 1 || $department->pivot->permission_for == 0))
                <span class="text-xs leading-5 text-bg-color bg-secondary py-1 px-2 rounded ml-1 mb-1 inline-block">
                    {{ $department->dptName }}
                </span>
            @endif
        @endforeach
    </td>
    <td class="px-2 py-3 text-sm">
        @foreach ($current_folder->department()->get() as $department)
            @if (isset($department->pivot->permission_for) && $department->pivot->permission_for == 0)
                <span class="text-xs leading-5 text-bg-color bg-secondary py-1 px-2 rounded ml-1 mb-1 inline-block">
                    {{ $department->dptName }}
                </span>
            @endif
        @endforeach
    </td>

    <td class="px-2 py-3 text-sm">
        <!-- DELETE using link -->
        {!! Form::open(['action' => ['FolderController@destroy', $current_folder->id], 'method' => 'DELETE', 'id' => 'form-delete-folders-' . $current_folder->id, 'class' => 'flex items-center']) !!}
        <a href="\folders\{{ $current_folder->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
            </svg>
        </a>
        <a href="#" class="left"><i class="material-icons"></i></a>
        <a href="/folders/{{ $current_folder->id }}/edit" class="center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
        </a>
        <a href="" class="right data-delete" data-form="folders-{{ $current_folder->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </a>

        <a href="/favorites/folder/{{ $current_folder->id }}/">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-red-500"
                fill="{{ $current_folder->hasBeenFavoritedBy(auth()->user()) ? 'red' : 'none' }}" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </a>
        {!! Form::close() !!}

    </td>

</tr>
