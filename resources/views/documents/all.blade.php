@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('documents.inc.head')

    {{-- @include('documents.inc.documents-list') --}}

    <div class="flex flex-row flex-wrap mt-2 mb-3 mx-4 gap-4 bg-white p-3"> 

        <table class="table-auto w-full text-left bg-colorspace-no-wrap">
            <thead>
                <tr class="border-b mb-2 pb-2">
                    <td class="px-1 py-1 text-main text-xs"> </td>
                    <td class="px-1 py-1 text-main text-xs">Name</td>
                    <td class="px-1 py-1 text-main text-xs">Version</td>
                    <td class="px-1 py-1 text-main text-xs">File size</td>
                    <td class="px-1 py-1 text-main text-xs">Date Modified</td>
                    <td class="px-1 py-1 text-main text-xs">type mime</td>
                </tr>

            </thead>
            <tbody>
                @if (isset($docs) && count($docs) > 0)
                    @foreach ($docs as $doc)
                        @include('inc.docs.doc',['doc' => $doc])
                    @endforeach
                @else
                    @include('inc.no-records.docs' )
                @endif
            </tbody>
        </table>

    </div>

    @include('inc.tables.docs')

    @include('inc.sidebar-footer')

    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection
