@extends('master.index')

@section('content')
    <div class="col-md-8">
        <h2 class="text-center m-5 text-black-50">Contador de cliques</h2>
        <p class="text-center  text-black-50">Aqui você pode verificar a quantidade de cliques que sua URL recebeu.</p>
        <form action="{{ route('clicks.count') }}" method="post">
            @csrf
            <div class="form-group">
                <label for=""></label>
                <input type="text" name="short_url" id="" class="form-control" placeholder="Cole sua URL curta..."
                    aria-describedby="helpId" required>
            </div>
            <button type="submit" class="btn btn-success mb-3" name="action_count">Verificar</button>
        </form>

        @isset($data)
            <div class="alert alert-success" role="alert">
                Seu link <strong>{{ Str::substr($data->link, 0, 20) }}</strong> foi visitado
                <strong>{{ $data->clicks }}</strong> vezes desde
                <strong>{{ date('d/m/Y', strtotime($data->updated_at)) }}</strong>.
                <br>
                <form action="{{ route('clicks.reset') }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-sm btn-danger reset-button mt-3" name="reset">Zerar</button>
                </form>
            </div>
        @endisset
    </div>
@endsection
