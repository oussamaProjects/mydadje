@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="h-full ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-4">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">
                                Backup Manager
                            </h3>
                        </div>
                        <div class="relative text-right">

                            <a href="/backup/create"
                                class="flex text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded ml-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <span class="ml-2">Create Backup</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-4 lg:grid-cols-4">
            <div class="col-span-3">
                <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">
                    <div
                        class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                        <div class="rounded-t mb-0 px-0 border-0">
                            <div class="block w-full overflow-x-auto">
                                <table class="items-center w-full bg-transparent border-collapse">
                                    <thead>
                                        <tr>
                                            <th
                                                class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Location</th>
                                            <th
                                                class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Name</th>
                                            <th
                                                class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Size</th>
                                            <th
                                                class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                                Last Modified</th>
                                            <th
                                                class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if (count($backups) > 0)
                                            @foreach ($backups as $b)
                                                <tr>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                        {{ $b['file_path'] }}</td>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                        {{ $b['file_name'] }}</td>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                        {{ round((int) $b['file_size'] / 1048576, 2) . ' MB' }}</td>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4">
                                                        {{ \Carbon\Carbon::createFromTimeStamp($b['last_modified'])->formatLocalized('%d %B %Y, %H:%M') }}
                                                    </td>
                                                    <td
                                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 whitespace-nowrap p-4 flex">
                                                        <a href="/backup/download?file_name={{ urlencode($b['file_name']) }}"
                                                            class="mr-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                                            </svg>
                                                        </a>
                                                        <a href="/backup/delete?file_name={{ urlencode($b['file_name']) }}"
                                                            class="">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1"
                                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <img src="{{ asset('img/undraw_Transfer_files_re_a2a9.svg') }}" alt="">
        </div>
    </div>



@endsection
