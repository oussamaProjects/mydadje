@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('categories.inc.head')

    <div class="grid grid-cols-3 sm:grid-cols-3 lg:grid-cols-3 p-4 gap-4">
        <div class="col-span-2">

            <div class="flex items-center p-4 gap-4 bg-bg-color">

                {!! Form::open(['action' => ['CategoriesController@update', $category->id], 'method' => 'PATCH', 'class' => 'w-full']) !!}

                <div class="mb-2 relative">
                    <label for="name" class="text-xs opacity-75 scale-75">
                        Nom de l'activité
                    </label>
                    {{ Form::text('name', $category->name, ['autocomplete' => 'off','class' =>'peer border border-main focus:outline-none focus:border-secondary shadow-sm focus:shadow-sm-sm w-full py-1 px-2 h-8 text-sm bg-bg-color','id' => 'category']) }}
                </div>


                <div class="flex items-end justify-end mt-4">
                    {{ Form::submit('Sauvegarder les modifications', ['class' =>'flex text-bg-color bg-secondary hover:text-main hover:bg-tertiary border py-2 px-6 text-tiny focus:outline-none transition hover:no-underline ml-2']) }}
                </div>

                {!! Form::close() !!}

            </div>
        </div>

        <button id="link_add_categorie" class="bg-white h-auto p-4" type="button">
            <img src="{{ asset('img/undraw_Add_files_re_v09g.svg') }}" alt="">
        </button>
    </div>

    @include('inc.sidebar-footer')

    @include('popups.addCategorie')
    @include('popups.scripts')
@endsection
