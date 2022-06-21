<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
$img = asset('assets/img/dog.png');
if (isset($_POST['action']) && !empty($_POST['url_converter'])) {
    $img = asset('assets/img/dog-puppy.png');
}
?>
<!doctype html>
<html lang="pt-br">

<head>

    {!! $head ?? '' !!}

    <link rel="icon" href="{{ asset('assets/img/dog-puppy.png') }}" />

    <!--Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ mix('assets/css/main.css') }}">
</head>

@include('master.components.header')

<body>
    <div class="container">
        <div class="row form">
            <div class="col-md-4" style="padding: 0;">
                <div class="container-img">
                    <img src="<?= $img ?>" alt="Dog Image">
                </div>
            </div>

            @include('master.components.alerts')

            @yield('content')


        </div>
        <!-- /.row -->
        <div class="description m-3 row">
            <div class="card text-left col-md-3 m-5">
                <div class="card-body">
                    <h4 class="card-title">Encurte seus links de maneira simples.</h4>
                    <p class="card-text">Aqui você encontra uma ferramenta gratuita para encurtar URLs como: links de
                        afiliados, perfis e páginas de redes sociais e qualquer site que desejar, é simples e fácil!
                        Encurte links do <a href="https://www.facebook.com/" target="_blank">Facebook</a>, <a
                            href="https://www.instagram.com/" target="_blank">Instagram</a>, <a
                            href="https://www.youtube.com" target="_blank">Youtube</a> e <a
                            href="https://www.whatsapp.com/" target="_blank">Whatsapp</a>. Encurte o link que você
                        quiser. </p>
                    </p>
                </div>
            </div>
            <div class="card text-left col-md-3 m-5">
                <div class="card-body">
                    <h4 class="card-title">Monitore em tempo real.</h4>
                    <p class="card-text">Com a ferramenta <a target="_blank" internal
                            href="{{ url('/') }}url">mynew.link </a>você também consegue monitorar a quantidades
                        de cliques e visitas que
                        o seu link recebeu. Basta clicar no menu "Minha url" e colar o seu link encurtado.
                    <p>
                </div>
            </div>
            <div class="card text-left col-md-3 m-5">
                <div class="card-body">
                    <h4 class="card-title">URLs personalizadas.</h4>
                    <p class="card-text">Com nossa ferramenta também é possível criar links personalizados, basta
                        clicar em
                        "Personalize" e escolher o nome desejado para o seu link.
                    <p>
                </div>
            </div>
        </div>
        <!-- /.description -->

    </div>
    <!-- /.container -->




    @include('master.components.footer')

    <script src="{{ mix('assets/js/main.js') }}"></script>
</body>

</html>
