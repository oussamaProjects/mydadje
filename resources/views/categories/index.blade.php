@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    @include('categories.inc.head')

    <div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-4 p-4 gap-4">
        
        <div class="col-span-3">
            <div class="flex flex-col text-center w-full px-2 pb-2 bg-white">
                <h1 class="sm:text-xl text-lg title-font my-2 text-gray-800 text-center p-2 uppercase">Tous les activités</h1>
                <div class="w-full overflow-x-auto">
                    <table
                        class="table-auto w-full text-left whitespace-no-wrap border border-bg-color">
                        <thead>
                            <tr>

                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm">
                                    Nom de l'acitivite</th>
                                <th
                                    class="px-2 py-3 title-font tracking-wider font-medium text-bg-color text-sm bg-main shadow-sm min-w-140-px">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($categories) > 0)
                                @foreach ($categories as $category)
                                    <tr id="tr_{{ $category->id }}" class="text-gray-800 ">

                                        <td class="px-2 py-3 text-sm">
                                            {{ $category->name }}</td>
                                        <td class="flex px-2 py-3 text-sm">

                                            <!-- DELETE using link -->
                                            {!! Form::open(['action' => ['CategoriesController@destroy', $category->id], 'method' => 'DELETE', 'id' => 'form-delete-categories-' . $category->id, 'class' => 'flex items-center']) !!}
                                            <a href="#" class="left"><i class="material-icons"></i></a>
                                            <a href="/categories/{{ $category->id }}/edit" class="center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <a href="" class="right data-delete"
                                                data-form="categories-{{ $category->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                            {!! Form::close() !!}

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        <div
                                            class="flex flex-col items-center justify-center text-sm pb-6 text-center w-full h-full">
                                            Créer une catégorie pour vos fichiers en
                                            <button id="link_add_categorie" class="flex text-secondary">
                                                <span class="ml-1">cliquant-ici</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <button id="link_add_categorie" class="bg-white h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Filing_system_re_56h6.svg') }}" alt="">
        </button>
    </div>

    @include('inc.sidebar-footer')

    @include('popups.addCategorie')
    @include('popups.scripts')

@endsection
