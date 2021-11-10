@extends('layouts.app')

@section('content')
    @include('inc.sidebar')
    <div class="ml-14 mt-20 mb-10 md:ml-64 bg-white p-4 ">

        <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-1 gap-4 mb-4">

            <div class="flex">
                <div class="text-lg font-semibold"> Users' Activities</div>
                @can('root')
                    <a href="logsdel" data-position="left" data-delay="50" data-tooltip="Tout effacer"
                        class="flex ml-auto text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        <span class="ml-1 font-semibold">Tout effacer</span>
                    </a>
                @endcan
            </div>
        </div>


        @if (count($logs) > 0)

            <div class="grid grid-cols-1 lg:grid-cols-1 gap-4">
                <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 w-full shadow-md rounded">
                    <div class="rounded-t mb-0 px-0 border-0">

                        <div class="block w-full overflow-x-auto">
                            <table class="table-auto items-center w-full bg-transparent border-collapse">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Subject
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            ID d'utilisateur
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            URL
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Method
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            IP
                                        </th>
                                        <th
                                            class="px-2 bg-gray-100 text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Agent
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $key => $log)
                                        <tr class="text-gray-700 ">
                                            <th
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap text-left">
                                                {{ ++$key }}
                                            </th>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->subject }}
                                            </td>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->user_id }}
                                            </td>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->url }}
                                            </td>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->method }}
                                            </td>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->ip }}
                                            </td>
                                            <td
                                                class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap">
                                                {{ $log->agent }}
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <tr>
                <td colspan="3">
                    <p class="p-4 text-center">
                        No Logs have been recorded yet ...
                    </p>
                </td>
            </tr>
        @endif


    </div>

@endsection
