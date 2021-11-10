@extends('layouts.app')

@section('content')

    @include('inc.sidebar')

    <div class="ml-14 mt-14 mb-10 md:ml-64">
        <div class="grid grid-cols-1 sm:grid-cols-4 md:grid-cols-4 lg:grid-cols-6 p-4 gap-4">

            <h3 class="flow-text"><i class="material-icons">folder</i> Dossiers
                <a href="#" class="btn red waves-effect waves-light right tooltipped" data-position="left" data-delay="50"
                    data-tooltip="Delete Selected folders">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 m-1" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </a>
                @can('upload')
                    <a href="/folders/create" class="btn waves-effect waves-light right tooltipped" data-position="left"
                        data-delay="50" data-tooltip="Upload New folder"><i class="material-icons">file_upload</i></a>
                @endcan
            </h3>

            <h6 class="flow-text orange-text">{{ count($results) }} Résultats</h6>

            <form action="/search" method="post" id="search-form">
                {{ csrf_field() }}
                <i class="material-icons prefix">search</i>
                <input type="text" name="search" id="search" placeholder="Recherche ...">
                <label for="search"></label>
            </form>

            @if (count($results) > 0)
                @foreach ($results as $res)
                    @foreach ($res as $r)
                        <div class="col m2 s6">
                            <a href="folders/{{ $r->id }}">
                                <div class="card hoverable indigo lighten-5 task" data-id="{{ $r->id }}">
                                    <input type="checkbox" class="filled-in" id="chk{{ $r->id }}"><label
                                        for="chk{{ $r->id }}"></label>
                                    <div class="card-content2 center">

                                        <h6>{{ $r->name }}</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endforeach
            @else
                <h5 class="teal-text">Aucun résultat :(</h5>
            @endif

        </div>
    </div>

@endsection
