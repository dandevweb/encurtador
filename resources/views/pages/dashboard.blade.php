@extends('master.index')

@section('content')
    <div class="col-md-8">
        <h2 class="text-center my-2 mx-5 text-black-50">Painel de Controle</h2>

        <div class="row">
            <div class="col-md-6">
                <div class="card text-left">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Total de visitas</h4>
                        <p class="card-text">{{ $visits }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-left">
                    <img class="card-img-top" src="holder.js/100px180/" alt="">
                    <div class="card-body">
                        <h4 class="card-title">Usuários Online</h4>
                        <p class="card-text">{{ $online }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <h3 class="text-center m-3">Cadastrados</h3>
        <table class="table table-responsive col-md-11 mx-auto">
            <thead>
                <tr>
                    <th scope="col">Criado em</th>
                    <th scope="col">Curta</th>
                    <th scope="col">Longa</th>
                    <th scope="col">Cliques</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($translates as $translate)
                    <tr>
                        <th scope="row">{{ date('d/m/Y', strtotime($translate->created_at)) }}</th>
                        <td>{{ $translate->new_link }}</td>
                        <td>{{ $translate->link }}</td>
                        <td>{{ $translate->clicks }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <div class="paginate">{{ $translates->links() }}</div>
    </div>
@endsection
