@extends('layouts.app')

@section('content')

    @include('inc.sidebar')


    @include('folders.inc.head')


    <div class="flex flex-row flex-wrap my-2 mx-4 gap-4 p-4 bg-bg-color shadow-md">
        @if (count($all_folders) > 0)
            @foreach ($all_folders as $folder)
                @include('inc.folders.folder',['folder' => $folder])
            @endforeach
        @else
            @include('inc.no-records.folders' )
        @endif

    </div>

    @include('inc.tables.folders',['current_folders'=> $all_folders])

    @include('inc.sidebar-footer')

    @include('popups.addFolder')
    @include('popups.addFile')
    @include('popups.addSubFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection
