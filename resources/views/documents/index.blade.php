@extends('layouts.app')

@section('content')
    @include('inc.sidebar')

    @include('documents.inc.head')

    @include('documents.inc.documents-list')

    @include('inc.tables.docs')

    @include('inc.sidebar-footer')

    @include('popups.addFile')
    @include('popups.addFolder')
    @include('popups.addCategorie')
    @include('popups.scripts')
@endsection
