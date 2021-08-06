<header>
    <nav class="navbar1 navbar navbar-expand-lg navbar-dark bg-light fixed-top py-0">

        <a class="navbar-brand d-lg-none p-0" href="index.php">
            <div class="float-left">
                <?php include('externo/logosm.html') ?>
            </div>
            <div class="float-left logo_div">
                <h2 class="logo_mobile">GuaShop</h2>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado" aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">

            <ul class="navbar-nav container-fluid justify-content-around">
                <li class="mostrar nav-item">
                    <a class="nav-link" href="lojas.php">Lojas</a>
                </li>

                <li class="mostrar nav-item">
                    <a class="nav-link" href="setores.php">Setores</a>
                </li>

                <li class="mostrar nav-item">
                    <a class="nav-link" href="promocoes.php">Promoções</a>
                </li>

                <li class="nav-item d-none d-lg-block">
                    <a class="navbar-brand p-0" href="index.php">
                        <div class="float-left">
                            <?php include('externo/logosm.html') ?>
                        </div>
                        <div class="float-left logo_div">
                            <h2 class="logo_mobile">GuaShop</h2>
                        </div>
                    </a>
                </li>

                <li class="mostrar nav-item">
                    <a class="nav-link" href="fazerparte.php">Fazer Parte</a>
                </li>

                <li class="mostrar nav-item">
                    <a class="nav-link" href="sobre.php">Sobre nós</a>
                </li>

                <li class="mostrar nav-item">
                <?php
                    if($_SESSION['logado'] == false):

                        echo '<a class="nav-link" href="login.php">Login</a>';
                    else:

                        echo '<a class="nav-link" href="minha_conta.php">Minha Conta</a>';
                    endif;
                ?>
                </li>
            </ul>
        </div>
    </nav>

    <nav class="navbar2 navbar smart-scroll navbar-expand-lg navbar-light bg-light py-0 pt-1 border-bottom shadow-sm">

        <div class="d-md-none pesquisamobile"> <!-- Mobile -->
            <button class="btn float-left" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <svg class="bi bi-search" width="2em" height="2em" viewBox="0 0 16 16" fill="#250f55" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
            </button>

            <div class="collapse float-left pesquisacolapso" id="collapseExample">
                <form class="my-2 w-100" action="pesquisa.php" method="GET">
                    <div class="form-row">

                        <div class=" col-10 my-0 py-0">
                            <input class="form-control btn-sm" id="pesquisa" type="search" <?php if(isset($pesquisa)) { echo "placeholder='$pesquisa'"; } else{ echo 'placeholder="Pesquisar"'; } ?> aria-label="Pesquisar" name="pesquisa">
                        </div>

                        <button type="submit" class="btn form-control col-2 my-0 py-0">
                            <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-arrow-right-circle" fill="#250f55" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path fill-rule="evenodd" d="M7.646 11.354a.5.5 0 0 1 0-.708L10.293 8 7.646 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0z"/>
                                <path fill-rule="evenodd" d="M4.5 8a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-none d-md-block"> <!-- Desktop -->
            <form class="form-inline my-2 my-lg-0" action="pesquisa.php" method="GET">

                <button type="submit" class="btn">
                <svg class="bi bi-search mx-2" width="2em" height="2em" viewBox="0 0 16 16" fill="#250f55" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
                </button>

                <input class="form-control btn-sm mr-sm-2" id="pesquisa" type="search" <?php if(isset($pesquisa)) { echo "placeholder='$pesquisa'"; } else{ echo 'placeholder="Pesquisar"'; } ?> aria-label="Pesquisar" name="pesquisa">
            </form>
        </div>


        <div class="navbar2-div ml-auto my-2">

            <?php
                if($_SESSION['logado'] != 1):

                    echo '<a href="cadastro.php" class="btn-conta btn btn-sm text-white py-1 px-3" type="button" name="button">Cadastrar</a>';
                else:

                    echo '<a href="externo/sair.php" class="btn-conta btn btn-sm text-white py-1 px-3" type="button" name="button">Sair</a>';
                endif;
            ?>

            <a href="favoritos.php">
                <svg class="mx-2" width="2em" viewBox="0 0 16 16" fill="#250f55">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                </svg>
            </a>

            <a href="carrinho.php">
                <svg class="bi bi-cart-fill mx-2" width="2em" height="2em" viewBox="0 0 16 16" fill="#250f55" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm7 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
            </a>
        </div>

    </nav>
</header>


<nav class="navbar3 navbar navbar-expand-lg shadow-sm d-none d-xl-block">
    <ul class="navbar-nav mr-auto">

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=1">
                <svg width="1em" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g><g>
                        <path d="M498.682,435.326L297.917,234.56L63.357,0H45.026l-3.743,9.511c-9.879,25.104-14.1,50.78-12.205,74.249
                        c2.16,26.752,12.323,49.913,29.392,66.982L241.58,333.852l24.152-24.152l169.285,189.293c16.84,16.84,45.825,17.84,63.665,0
                        C516.236,481.439,516.236,452.879,498.682,435.326z"/>
                    </g></g><g>	<g>
                        <path d="M156.728,291.442L13.317,434.853c-17.552,17.552-17.552,46.113,0,63.665c16.674,16.674,45.519,18.146,63.665,0
                        l143.412-143.412L156.728,291.442z"/>
                    </g></g><g>	<g>
                        <path d="M490.253,85.249l-81.351,81.35l-21.223-21.222l81.351-81.351l-21.222-21.222l-81.35,81.35l-21.222-21.222l81.351-81.35
                        L405.366,0.361L299.256,106.471c-12.981,12.981-20.732,30.217-21.828,48.535c-0.277,4.641-1.329,9.206-3.074,13.548l68.929,68.929
                        c4.342-1.747,8.908-2.798,13.548-3.075c18.318-1.093,35.554-8.846,48.535-21.827l106.11-106.109L490.253,85.249z"/>
                    </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
                Fast Food
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=2">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-basket3-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.243 1.071a.5.5 0 0 1 .686.172l3 5a.5.5 0 0 1-.858.514l-3-5a.5.5 0 0 1 .172-.686zm-4.486 0a.5.5 0 0 0-.686.172l-3 5a.5.5 0 1 0 .858.514l3-5a.5.5 0 0 0-.172-.686z"/>
                    <path d="M13.489 14.605A.5.5 0 0 1 13 15H3a.5.5 0 0 1-.489-.395L1.311 9H14.69l-1.201 5.605z"/>
                    <rect width="16" height="2" y="6" rx=".5"/>
                </svg>
                Alimentação
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=3">
                <svg width="1em" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g><g>
                    <polygon points="289.262,222.738 289.262,134.423 222.738,134.423 222.738,222.738 134.423,222.738 134.423,289.262
                    222.738,289.262 222.738,377.577 289.262,377.577 289.262,289.262 377.577,289.262 377.577,222.738 		"/>
                    </g></g><g><g>
                    <path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256
                    s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98
                    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.98z M407.576,319.261h-88.315v88.315H192.738v-88.315h-88.315
                    V192.738h88.315v-88.315h126.523v88.315h88.315V319.261z"/>
                    </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
                Farmácia
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=4">
                <svg version="1.1" width="1em" fill="currentColor" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 505.589 505.589" style="enable-background:new 0 0 505.589 505.589;" xml:space="preserve">
                    <g><g><g>
                        <polygon points="115.652,503.076 252.795,503.076 389.938,503.076 389.938,484.79 115.652,484.79"/>
                        <path d="M401.813,41.281c-4.569-3.518-9.766-6.136-15.313-7.714l-53.928-15.411c-1.495-0.428-2.857-1.23-3.955-2.33
                        L315.304,2.514c-19.258,10.252-40.694,15.736-62.509,15.991c-21.815-0.255-43.251-5.739-62.509-15.991l-13.313,13.312
                        c-1.099,1.101-2.46,1.903-3.955,2.331L119.09,33.567c-5.547,1.578-10.743,4.196-15.313,7.714L0,121.112l62.866,94.313
                        l17.476-13.983l-45.44-68.151c-2.741-4.199-1.588-9.823,2.585-12.605s9.807-1.683,12.629,2.462l44.557,66.827l6.122-4.898
                        c2.745-2.196,6.506-2.623,9.675-1.1s5.183,4.728,5.183,8.243v274.286h274.286V192.219c0-3.516,2.014-6.72,5.183-8.243
                        c3.168-1.523,6.929-1.095,9.675,1.1l6.122,4.898l44.556-66.827c2.812-4.174,8.467-5.291,12.655-2.499s5.331,8.442,2.56,12.642
                        l-45.44,68.151l17.476,13.983l62.866-94.313L401.813,41.281z"/>
                    </g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                </svg>
                Vestuário
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=5">
                <svg id="Capa_1" enable-background="new 0 0 512 512" viewBox="0 0 512 512" width="1em" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="m256 267c15.562 0 30.701-1.63 45.438-4.334 2.331-55.844 48.156-100.666 104.562-100.666 20.105 0 36.971 13.339 42.724 31.566 22.451-17.075 42.169-34.459 56.303-48.895 3.735-2.358 6.226-6.24 6.826-10.605.615-4.38-.732-8.789-3.677-12.07-2.959-3.296-74.403-81.539-173.368-112.784-27.245-8.658-56.323-3.737-78.808 12.64-22.515-16.377-51.65-21.284-78.794-12.641-98.979 31.245-170.424 109.488-173.383 112.784-5.098 5.698-5.098 14.312 0 20.01 4.571 5.097 114.496 124.995 252.177 124.995zm-103.887-147.993c74.033-42.715 135.249-42.246 207.832.029 4.614 2.695 7.456 7.646 7.441 12.993s-2.871 10.283-7.5 12.964c-36.811 21.24-71.762 32.007-103.886 32.007-32.476 0-67.456-10.781-103.945-32.036-4.614-2.695-7.456-7.646-7.441-12.993.014-5.347 2.87-10.284 7.499-12.964z"/><path d="m319.53 131.956c-44.678-19.775-81.592-20.01-127.061.088 44.664 19.761 81.563 19.98 127.061-.088z"/><path d="m406 192c-41.353 0-75 33.647-75 75v30h90v-90c0-8.291-6.709-15-15-15z"/><path d="m301 342v45h150v-45c0-8.291-6.709-15-15-15h-120c-8.291 0-15 6.709-15 15z"/><path d="m301 492c0 8.291 6.709 15 15 15h120c8.291 0 15-6.709 15-15v-75h-150z"/></g></svg>
                Perfumaria
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=6">
                <svg width="1em" viewBox="0 -32 512.00011 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="m342.382812 239.351562c-23.039062-35.941406-62.277343-57.402343-104.964843-57.402343s-81.925781 21.460937-104.960938 57.402343l-55.515625 86.605469c-9.210937 14.367188-13.460937 30.96875-12.292968 47.996094 1.167968 17.03125 7.648437 32.890625 18.738281 45.875 11.097656 12.972656 25.761719 21.839844 42.40625 25.644531 16.644531 3.804688 33.707031 2.179688 49.339843-4.691406l1.046876-.464844c39.335937-16.945312 84.285156-16.789062 123.519531.464844 10.121093 4.449219 20.84375 6.699219 31.664062 6.699219 5.882813 0 11.800781-.667969 17.664063-2.003907 16.644531-3.800781 31.308594-12.667968 42.410156-25.644531 11.09375-12.972656 17.578125-28.835937 18.75-45.871093 1.171875-17.035157-3.078125-33.632813-12.289062-48.007813zm0 0"/><path d="m91.894531 239.238281c16.515625-6.34375 29.0625-19.652343 35.328125-37.476562 5.964844-16.960938 5.476563-36.109375-1.378906-53.921875-6.859375-17.800782-19.335938-32.332032-35.132812-40.921875-16.59375-9.019531-34.824219-10.488281-51.3125-4.132813-33.171876 12.753906-48.394532 53.746094-33.929688 91.398438 11.554688 29.96875 38.503906 48.886718 65.75 48.886718 6.957031 0 13.933594-1.234374 20.675781-3.832031zm0 0"/><path d="m199.613281 171.386719c41.46875 0 75.207031-38.4375 75.207031-85.683594 0-47.257813-33.738281-85.703125-75.207031-85.703125-41.464843 0-75.199219 38.445312-75.199219 85.703125 0 47.246094 33.734376 85.683594 75.199219 85.683594zm0 0"/><path d="m329.496094 192.4375h.003906c6.378906 2.117188 12.886719 3.128906 19.367188 3.128906 30.242187 0 59.714843-22.011718 70.960937-55.839844 6.476563-19.472656 6.050781-40.0625-1.199219-57.972656-7.585937-18.75-21.644531-32.359375-39.589844-38.324218-17.949218-5.964844-37.359374-3.476563-54.660156 7-16.527344 10.007812-29.191406 26.246093-35.660156 45.71875-13.652344 41.078124 4.640625 84.273437 40.777344 96.289062zm0 0"/><path d="m487.875 182.4375-.011719-.011719c-28.597656-21.125-71.367187-11.96875-95.347656 20.421875-23.957031 32.40625-20.210937 75.972656 8.34375 97.113282 10.414063 7.714843 22.71875 11.402343 35.3125 11.402343 21.949219 0 44.785156-11.203125 60.050781-31.804687 23.953125-32.40625 20.210938-75.972656-8.347656-97.121094zm0 0"/></svg>
                Petshop
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=7">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 3.293l6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                </svg>
                Móveis
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=8">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-tv-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 13.5A.5.5 0 0 1 3 13h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM2 2h12s2 0 2 2v6s0 2-2 2H2s-2 0-2-2V4s0-2 2-2z"/>
                </svg>
                Eletrodomésticos
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link py-0" href="setor.php?id=9">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-grid-3x2-gap-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V4zM1 9a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V9zm5 0a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V9z"/>
                </svg>
                Diversos
            </a>
        </li>
    </ul>
</nav>

<div class="clearfix"></div>
