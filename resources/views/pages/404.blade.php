@extends('master.index')

@section('content')
    <div class="col-md-8 page-404">

        <h2 class="text-center m-5 p-5 text-black-50"> 404 <br> Página não encontrada!</h2>

        <h3 class="text-center m-5"><a href="{{ route('home') }}">
                < Home</a>
        </h3>

    </div>
    <!--col-md-8-->
@endsection
