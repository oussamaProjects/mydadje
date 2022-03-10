<!-- Sidebar -->
<div
    class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-56 bg-main  h-full text-bg-color transition-all duration-300 border-none z-10 sidebar">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between">
        <ul class="flex flex-col py-4 space-y-1">
            <li class="px-5 hidden md:block">
                <div class="flex flex-row items-center h-8">
                    <div class="text-sm font-light tracking-wide text-bg-color uppercase">Principal</div>
                </div>
            </li>

            <li>
                <a href="/shared"
                    class="{{ request()->is('shared*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        @include('inc.icons.document')
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Documents partagés</span>
                </a>
            </li>

            <li>
                <a href="/documents"
                    class="{{ request()->is('documents*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        @include('inc.icons.document')
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Documents</span>
                    <span
                        class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-main bg-tertiary rounded-full">{{ $docs_count }}</span>
                </a>
            </li>

            <li>
                <a href="/folders"
                    class="{{ request()->is('folders*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary hover:text-bg-color-800 text-bg-color-600 border-l-4 border-transparent hover:border-main pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        @include('inc.icons.folder')

                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Dossiers</span>
                    <span
                        class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-main bg-tertiary rounded-full">{{ $folders_count }}</span>
                </a>
            </li>

            @hasanyrole('Root|Admin')
                <li>
                    <a href="/categories"
                        class="{{ request()->is('categories*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.tags')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Activités</span>
                    </a>
                </li>
            @endhasanyrole

            @hasrole('Root')
                <li>
                    <a href="/users"
                        class="{{ request()->is('users*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.users')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Utilisateurs</span>
                        <span
                            class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-main bg-tertiary rounded-full">{{ $users_count }}</span>
                    </a>
                </li>

                <li>
                    <a href="/departments"
                        class="{{ request()->is('departments*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.bell')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Départments</span>
                        <span
                            class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-main bg-tertiary rounded-full">{{ $dept_count }}</span>
                    </a>
                </li>

                <li>
                    <a href="/subsidiaries"
                        class="{{ request()->is('subsidiaries*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.bell')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Filiales</span>
                        <span
                            class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-main bg-tertiary rounded-full">{{ $subs_count }}</span>
                    </a>
                </li>
            @endhasrole

            <li>
                <a href="/mydocuments"
                    class="{{ request()->is('mydocuments*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                    <span class="inline-flex justify-center items-center ml-4">
                        @include('inc.icons.document')
                    </span>
                    <span class="ml-2 text-sm tracking-wide truncate">Mes documents</span>
                </a>
            </li>

            @hasrole('User')
            @endhasrole

            @hasrole('Root')
                <li class="px-5 hidden md:block">
                    <div class="flex flex-row items-center mt-5 h-8">
                        <div class="text-sm font-light tracking-wide text-bg-color uppercase">Paramètres</div>
                    </div>
                </li>

                <li>
                    <a href="/backup"
                        class="{{ request()->is('backup*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.settings')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Backup Manager</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="/roles"
                        class="{{ request()->is('roles*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.users')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Les rôles</span>
                    </a>
                </li> --}}

                <li>
                    <a href="/logs"
                        class="{{ request()->is('logs*') ? 'bg-secondary text-bg-color-800' : '' }} relative flex flex-row items-center h-7 focus:outline-none hover:bg-secondary text-bg-color-600 hover:text-bg-color-800 border-l-4 border-transparent hover:border-main pr-6">
                        <span class="inline-flex justify-center items-center ml-4">
                            @include('inc.icons.settings')
                        </span>
                        <span class="ml-2 text-sm tracking-wide truncate">Journaux d'accès</span>
                    </a>
                </li>
            @endhasrole

        </ul>

        <div class="flex flex-col m-2 space-y-1 text-secondary bg-tertiary font-medium rounded-sm">
            <div class="flex font-medium text-sm px-2 py-1">Favoris documents <span
                    class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-tertiary bg-main rounded-full">{{ $favorites_docs_count }}</span>
            </div>
            <div class="flex flex-col px-2 py-2 m-0 bg-white">
                @if (!is_null($favorites_docs))
                    @foreach ($favorites_docs as $document)
                        <a href="/documents/{{ $document->id }}"
                            class="flex items-center justify-start text-xxs capitalize m-0">
                            @include('inc.mime-type-icon', ['doc'=>$document])
                            <span class="ml-1">{{ $document->name }}</span>
                        </a>
                    @endforeach
                @else
                    No favorites
                @endif
            </div>
        </div>

        <div class="flex flex-col m-2 space-y-1 text-secondary bg-tertiary font-medium rounded-sm">
            <div class="flex font-medium text-sm px-2 py-1">Favoris folders <span
                    class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-tertiary bg-main rounded-full">{{ $favorites_folders_count }}</span>
            </div>
            <div class="flex flex-col px-2 py-2 m-0 bg-white">
                @if (!is_null($favorites_folders))
                    @foreach ($favorites_folders as $folder)
                        <a href="/folders/{{ $folder->id }}"
                            class="flex items-center justify-start text-xxs capitalize m-0">
                            @include('inc.folder-icon', [ 'folder_icon'=> $folder])
                            <span class="ml-1">{{ $folder->name }}</span>
                        </a>
                    @endforeach
                @else
                    No favorites
                @endif
            </div>
        </div>

        <p class="mb-14 px-5 py-3 hidden md:block text-center text-xs">Copyright DocCenter @2022</p>
    </div>
</div>
<!-- ./Sidebar -->


<div class="h-screen ml-14 mt-14 md:ml-56">
