@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    <div class="ml-14 mt-20 mb-10 md:ml-64 bg-white">

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="flex flex-col text-center w-full mb-4">
                <h1 class="sm:text-2xl text-xl font-medium title-font mb-2 text-gray-900">Documents partagés</h1>
            </div>
            <div class="w-full">
                <table class="table-auto w-full text-left whitespace-no-wrap">
                    <thead>
                        <tr>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                File Name
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Owner
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Department
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Uploaded At
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Expires At
                            </th>
                            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">
                                Actions
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @if (count($shared) > 0)
                            @foreach ($shared as $share)
                                <tr id="">
                                    <td class="px-4 py-3 text-sm">{{ $share->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $share->user->name }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $share->user->department['dptName'] }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $share->updated_at->toDayDateTimeString() }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $share->created_at->toDayDateTimeString() }}</td>
                                    <td class="px-4 py-3 text-sm flex">
                                        <a href="documents/open/{{ $share->document_id }}" class="tooltipped"
                                            data-position="left" data-delay="50" data-tooltip="Open">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        &nbsp;
                                        <a href="documents/download/{{ $share->document_id }}" class="tooltipped"
                                            data-position="left" data-delay="50" data-tooltip="Download">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td></td>
                                <td colspan="4">
                                    <h5 class="p-6 text-center">No Document has been uploaded</h5>
                                </td>
                                <td></td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
