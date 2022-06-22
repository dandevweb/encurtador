@extends('master.index')

@section('content')
    <div class="col-md-8">
        <div class="container mt-5 mb-5">
            <div class="wrapper">
                <form action="{{ route('login') }}" method="post" name="Login_Form" class="form-signin">
                    @csrf
                    <h3 class="form-signin-heading text-black-50">Faça o login</h3>
                    <hr class="colorgraph"><br>

                    <input type="email" class="form-control" name="email" placeholder="E-mail" required=""
                        autofocus="" />
                    <input type="password" class="form-control" name="password" placeholder="Senha" required="" />

                    <div class="form-group-login right">
                        <label>Manter Conectado</label>
                        <input type="checkbox" name="" />
                    </div>
                    <!--form-group-login-->

                    <button class="btn btn-lg btn-primary btn-block" name="action" value="Login"
                        type="Submit">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
