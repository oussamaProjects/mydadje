@extends('layouts.app')

@section('content')
    @include('inc.sidebar')


    <div class="grid grid-cols-1 lg:grid-cols-1 px-4 pt-4 pb-3 gap-4">
        <div class="relative flex flex-col break-words bg-white w-full shadow-sm rounded">
            <div class="rounded-t mb-0 px-0 border">
                <div class="flex flex-wrap items-center px-2 py-3">

                    <div class="relative w-full max-w-full flex flex-grow flex-1">
                        <h3 class="font-semibold text-base text-gray-800 ">
                            Activités des utilisateurs
                        </h3>
                    </div>

                    <div class="flex items-end justify-end">
                        @can('root')
                            <a href="logsdel" data-position="left" data-delay="50" data-tooltip="Tout effacer"
                                class="flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-auto">
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
            </div>
        </div>
    </div>

    @if (count($logs) > 0)
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-4 p-4">
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-white w-full shadow-sm">
                <div class="rounded-t mb-0 px-0 border">

                    <div class="block w-full overflow-x-auto">
                        <table
                            class="table-auto w-full text-left whitespace-no-wrap border border-bg-color border border-bg-color">
                            <thead>
                                <tr>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        Subject
                                    </th>
                                    <th
                                        class="w-32 px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        ID d'utilisateur
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        URL
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        Method
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        IP
                                    </th>
                                    <th
                                        class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-xs bg-main shadow-sm">
                                        Agent
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $key => $log)
                                    <tr class="text-gray-800 ">
                                        <th
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap text-left">
                                            {{ ++$key }}
                                        </th>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
                                            {{ $log->subject }}
                                        </td>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
                                            {{ App\User::where('id', $log->id)->first()->name ?? '' }}
                                        </td>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
                                            {{ $log->url }}
                                        </td>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
                                            {{ $log->method }}
                                        </td>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
                                            {{ $log->ip }}
                                        </td>
                                        <td
                                            class="border-t-0 px-2 py-2 align-middle border-l-0 border-r-0 text-xs bg-colorspace-nowrap">
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


    @include('inc.sidebar-footer')


@endsection
