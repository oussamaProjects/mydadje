 @extends('layouts.app')

 @section('content')
     @include('inc.sidebar')
 
     @include('documents.inc.head')

     @include('inc.tables.docs')

     @include('inc.sidebar-footer')

     @include('popups.addCategorie')
     
     @include('popups.addFile')
     @include('popups.scripts')
     
 @endsection
