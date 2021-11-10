@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="pt-20 ml-14 mb-10 md:ml-64 border" style=" ">
        <div class="flex flex-col w-full p-4">
            <h1 class="sm:text-2xl text-xl font-medium title-font text-gray-900">Ajouter le document</h1>
        </div>

        <div class="grid grid-cols-3 sm:grid-cols-3 md:grid-cols-3 lg:grid-cols-3">
            <div class="col-span-2">
                {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-2 p-4 gap-4']) !!}

                {{ csrf_field() }}

                <div class="">
                    <div class="mb-4 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Nom
                            de fichier</label>
                        {{ Form::text('name', '', ['id' => 'name', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                        @if ($errors->has('name'))
                            <span class="text-red-600 text-xs">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="mb-4 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">Description</label>
                        {{ Form::textarea('description', '', ['id' => 'description', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                        @if ($errors->has('description'))
                            <span class="text-red-600 text-xs">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                </div>


                <div class="">
                    <div class="mb-4 relative">
                        <label for="ref" class="text-xs opacity-75 scale-75">
                            Réference
                        </label>
                        {{ Form::text('ref', '', ['id' => 'ref', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                        @if ($errors->has('ref'))
                            <span class="text-red-600 text-xs">{{ $errors->first('ref') }}</span>
                        @endif
                    </div>

                    <div class="mb-4 relative">
                        <label for="name" class="text-xs opacity-75 scale-75">
                            Version
                        </label>
                        {{ Form::text('version', '', ['id' => 'version', 'class' => 'peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm w-full py-1 px-2 h-10 placeholder-transparent']) }}
                        @if ($errors->has('version'))
                            <span class="text-red-600 text-xs">{{ $errors->first('version') }}</span>
                        @endif
                    </div>
                    <div class="mb-4 relative hidden">
                        {{ Form::checkbox('isExpire', 1, true, ['id' => 'isExpire']) }}
                        <label for="name" class="text-xs opacity-75 scale-75">Does
                            Not Expire</label>
                    </div>
                </div>



                <div class="mb-4 relative">
                    <label class="text-xs opacity-75 scale-75">
                        Category (Optional)
                    </label>
                    {{ Form::select('category_id[]', $categories, null, ['multiple' => 'multiple', 'id' => 'category', 'class' => 'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                    @if ($errors->has('category'))
                        <span class="text-red-600 text-xs">{{ $errors->first('category') }}</span>
                    @endif
                </div>

                <div class="mb-4 relative">
                    <label class="text-xs opacity-75 scale-75">
                        Folder (Optional)
                    </label>
                    {{ Form::select('folder_id[]', $folders, null, ['multiple' => 'multiple', 'id' => 'folder', 'class' => 'form-multiselect peer border border-gray-200 focus:outline-none rounded focus:border-gray-500 focus:shadow-sm block w-full py-2']) }}
                    @if ($errors->has('folder'))
                        <span class="text-red-600 text-xs">{{ $errors->first('folder') }}</span>
                    @endif
                </div>



                <div class="col-span-2">

                    <div class="mb-4 relative">
                        <h3 class="text-gray-900 text-lg mt-6 mb-4 font-medium title-font uppercase">Autorisation</h3>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3">
                            @if (count($depts) > 0)
                                @foreach ($depts as $dept)

                                    <div class="mb-6">
                                        <div class="text-gray-900 mb-2 font-medium title-font">
                                            {{ $dept->dptName }}
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                value="{{ $dept->id }}_all" id="{{ $dept->id }}_all">
                                            <label for="{{ $dept->id }}_all">All</label>
                                        </div>

                                        <div class="">
                                            <input type="radio" name="permissions_{{ $dept->id }}[]"
                                                id="{{ $dept->id }}_admins" value="{{ $dept->id }}_admins"
                                                checked>
                                            <label for="{{ $dept->id }}_admins">Admins</label>
                                        </div>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="mb-4 relative">
                        <div class="btn white">
                            <span class="black-text">Choisir le fichier (Max: 50MB)</span>
                            {{ Form::file('file') }}
                            @if ($errors->has('file'))
                                <span class="text-red-600 text-xs">{{ $errors->first('file') }}</span>
                            @endif
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <div class="mb-4 relative">
                        <p class="center">
                            {{ Form::submit('Sauvegarder', ['class' => 'text-white bg-gray-900 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 text-lg']) }}
                        </p>
                    </div>
                </div>


                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
