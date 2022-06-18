<header>
    <nav class="navbar navbar-expand-lg
        navbar-light bg-light">
        <a style="color: #FC9502;" class="navbar-brand" href="{{ route('home') }}">mynew.link</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('url.clicks') }}">Minha Url</a>
                </li>
            </ul>
            <?php
        if (isset($_SESSION['login'])) {
            ?>
            <span class="navbar-text">
                <a class="nav-link" href="<?= INCLUDE_PATH_PANEL ?>?logout">Sair</a>
            </span>
            <?php } ?>
        </div>
    </nav>
</header>
