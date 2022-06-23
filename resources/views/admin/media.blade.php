@extends('layouts.ad')
@section('title')
   Thư Viện Hình Ảnh Video
@endsection
@section('content')
    <div class="container-fluid mt-2">
        <div class="row card text-center">
            <div id="ckfinder-widget"></div>
            
        </div>
    <script src="https://cdn.jsdelivr.net/gh/google/code-prettify@master/loader/run_prettify.js"></script>
    <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>
            <script>
                CKFinder.widget( 'ckfinder-widget', {
                    width: '100%',
                    height: 700
                } );
            </script>
    
@endsection
