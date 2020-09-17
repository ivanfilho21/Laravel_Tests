@extends('layouts.root')

@push('head_scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>
@endpush

@push('head_styles')
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&amp;subset=latin-ext" rel="stylesheet">
    <link href="{{ asset('evolo/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('evolo/css/fontawesome-all.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('evolo/css/swiper.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('evolo/css/magnific-popup.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('evolo/css/styles.css') }}" rel="stylesheet">
@endpush

@section('body_content')
    @yield('content')
@endsection

@section('body_scripts')
    <script src="{{ asset('evolo/js/jquery.min.js') }}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
    {{-- <script src="{{ asset('evolo/js/popper.min.js') }}"></script> <!-- Popper tooltip library for Bootstrap --> --}}
    <script src="{{ asset('evolo/js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
    {{-- <script src="{{ asset('evolo/js/jquery.easing.min.js') }}"></script> <!-- jQuery Easing for smooth scrolling between anchors --> --}}
    {{-- <script src="{{ asset('evolo/js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders --> --}}
    {{-- <script src="{{ asset('evolo/js/jquery.magnific-popup.js') }}"></script> <!-- Magnific Popup for lightboxes --> --}}
    {{-- <script src="{{ asset('evolo/js/validator.min.js') }}"></script> <!-- Validator.js - Bootstrap plugin that validates forms --> --}}
    <script src="{{ asset('evolo/js/scripts.js') }}"></script> <!-- Custom scripts -->
@endsection