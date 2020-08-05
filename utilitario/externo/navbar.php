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

        <li class="nav-item d-none d-md-block">
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
              if($_SESSION['logado'] != 1) {

                echo '<a class="nav-link" href="login.php">Login</a>';
              }
              else {

                echo '<a class="nav-link" href="minha_conta.php">Minha Conta</a>';
              }
            ?>

          </a>
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
        if($_SESSION['logado'] != 1) {

          echo '<a href="cadastro.php" class="btn-conta btn btn-sm text-white py-1 px-3" type="button" name="button">Cadastrar</a>';
        }
        else {

          echo '<a href="externo/sair.php" class="btn-conta btn btn-sm text-white py-1 px-3" type="button" name="button">Sair</a>';
        }
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
      <a class="nav-link py-0" href="setor.php?id=1"><i class="fas fa-hamburger"></i> Fast Food </a>
    </li>

    <li class="nav-item">
      <a class="nav-link py-0" href="setor.php?id=2"><i class="fas fa-utensils"></i> Alimentação </a>
    </li>

    <li class="nav-item">
      <a class="nav-link py-0" href="setor.php?id=3"><i class="fas fa-prescription-bottle-alt"></i> Farmácia</a>
    </li>

    <li class="nav-item">
      <a class="nav-link py-0" href="setor.php?id=4"><i class="fas fa-tshirt"></i> Vestuário</a>
    </li>

    <li class="nav-item">
      <a class="nav-link py-0" href="setor.php?id=5"><i class="fas fa-ring"></i> Perfumaria</a>
    </li>

    <li class="nav-item">
      <a class="nav-link py-0" href="setor.php?id=6"><i class="fas fa-paw"></i> Petshop</a>
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

<div class="clearfix">

</div>
