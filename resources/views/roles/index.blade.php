@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mb-14 md:ml-64">
        <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4 mt-14">

            <!-- Roles -->
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">Roles &amp; Permissions</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        ID.</th>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Permissions</th>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700 ">
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $r)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2 text-left">
                                        {{ $r->name }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ $r->permissions()->pluck('name')->implode(' ') }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        <a href="roles/{{ $r->id }}/edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Roles -->
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 p-4 gap-4">

            <!-- Roles -->
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">Roles</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        ID.</th>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700 ">
                                    @if (count($roles) > 0)
                                        @foreach ($roles as $key => $role)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2 text-left">
                                        {{ ++$key }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ $role->name }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Roles -->

            <!-- Permissions -->
            <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50   w-full shadow-md rounded">
                <div class="rounded-t mb-0 px-0 border-0">
                    <div class="flex flex-wrap items-center px-4 py-2">
                        <div class="relative w-full max-w-full flex-grow flex-1">
                            <h3 class="font-semibold text-base text-gray-900 ">Permissions</h3>
                        </div>
                        <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                        </div>
                    </div>
                    <div class="block w-full overflow-x-auto">
                        <table class="items-center w-full bg-transparent border-collapse">
                            <thead>
                                <tr>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        ID.</th>
                                    <th
                                        class="px-4 bg-gray-100   text-gray-500 align-middle border border-solid border-gray-200 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                        Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-gray-700 ">
                                    @if (count($permissions) > 0)
                                        @foreach ($permissions as $key => $permission)
                                <tr>
                                    <th
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2 text-left">
                                        {{ ++$key }}</td>
                                    <td
                                        class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-2">
                                        {{ $permission }}</td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- ./Permissions -->

        </div>
    </div>

@endsection
