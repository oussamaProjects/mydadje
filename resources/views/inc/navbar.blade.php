<!-- Header -->
<div class="fixed w-full flex items-center justify-between h-14 text-white z-10">


    @if (!Auth::guest())
        <div class="flex items-center justify-start md:justify-center w-14 md:w-64 h-14 bg-gray-900   border-none">
            <span class="hidden md:block font-bold text-2xl">DoCenter</span>
        </div>
    @endif

    <div class="flex justify-between items-center h-14 bg-gray-900   header-right">

        @if (!Auth::guest())
            <form action="/search" method="post" id="search-form"
                class="bg-white rounded flex items-center w-full max-w-xl mr-4 p-2 shadow-sm border border-gray-200 ">
                {{ csrf_field() }}

                <button class="outline-none focus:outline-none">
                    <svg class="w-5 text-gray-600 h-5 cursor-pointer" fill="none" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <input type="search" name="search" id="search" placeholder="Recherche ..."
                    class="w-full pl-3 text-sm text-black outline-none focus:outline-none bg-transparent" />
            </form>
        @endif

        <ul class="flex items-center ml-auto">

            @if (Auth::guest())

                <li>
                    <a href="{{ route('login') }}" class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        Connexion
                    </a>
                </li>

                <li>
                    <a href="{{ route('register') }}" class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        S'inscrire
                    </a>
                </li>

            @else

                <li>
                    <a href="/requests" class="flex items-center mr-4">
                        <span class="inline-flex mr-1 relative">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span
                                class="absolute w-5 h-5 rounded-full flex items-center justify-center bg-red-600 text-white text-xs -top-2 -right-2 p-2">{{ $requests }}</span>
                        </span>
                        <span class="ml-2">
                            Demandes d'enregistrement de compte
                        </span>
                    </a>
                </li>

                <li>
                    <div class="block w-px h-6 mx-3 bg-gray-400"></div>
                </li>

                <li>
                    @if ($trashfull > 0)
                        <a href="/trash" class="flex items-center">
                            <span class="inline-flex mr-1 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1 text-red-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                <span
                                    class="absolute w-5 h-5 rounded-full flex items-center justify-center bg-red-600 text-white text-xs -top-2 -right-2 p-2">{{ $trashfull }}</span>
                            </span>
                        </a>
                    @else
                        <span class="flex items-center">
                            <span class="inline-flex mr-1 relative">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </li>

                <li>
                    <div class="block w-px h-6 mx-3 bg-gray-400"></div>
                </li>

                <li>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="flex items-center mr-4">
                        <span class="inline-flex mr-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </span>
                        Se déconnecter
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endif
        </ul>
    </div>
</div>
<!-- ./Header -->
