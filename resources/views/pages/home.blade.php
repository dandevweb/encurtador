@extends('master.index')

@section('content')
    <div class="col-md-8">
        <h2 class="text-center m-5 text-black-50">Encurte sua URL</h2>
        <form action="{{ route('url.converter') }}" method="post">
            @csrf
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="url_converter" id="" class="form-control"
                    placeholder="Cole seu link aqui..." aria-describedby="helpId">
            </div>

            <div class="text-center">
                <a class="center" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                    aria-controls="collapseExample">Personalize <br>
                    <i class="fas fa-chevron-down"></i>
                </a>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="form-group">
                    <span>{{ route('home') }}/</span><input type="text" name="url_personal" id=""
                        class="form-control" placeholder="URL personalizada..." aria-describedby="helpId">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-success mb-3">Encurtar</button>
        </form>

        @if (session('insert'))
            <br>
            <div class="alert alert-success" role="alert">
                Seu link foi gerado com sucesso!
                <input class="form-control" id="new_url" type="text" value="{{ session('new_url') }}" /><i
                    class="fas fa-copy" id="copy"></i>
                <div class="box-alert copied text-center">
                    <i class="fa fa-check"></i>Copiado.
                </div>
            </div>
        @endif
    </div>
    <!-- /.col-md-8 -->
@endsection
