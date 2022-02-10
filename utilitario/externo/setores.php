<?php
    // Seleciona 4 produtos com o setor

    $setor_final = '%' . $setor . '%';
    $tabela = 'produto';

    if ($tamanho == 4): // Se ocupa uma tela inteira

        $sql = $conexao->prepare(
            'SELECT
                *
            FROM
                imagem i
                JOIN produto p ON (i.referencia_refe = p.id_prod)
                JOIN loja l ON (l.id_loja = p.id_loja)
            WHERE
                i.tabela_imag = :tabela
                AND p.id_seto LIKE :setor
            ORDER BY
                p.id_prod LIMIT 4'
        );

        $grid_xl = 3;
    else: // Se ocupa metade da tela

        $sql = $conexao->prepare(
            'SELECT
                *
            FROM
                imagem i
                JOIN produto p ON (i.referencia_refe = p.id_prod)
                JOIN loja l ON (l.id_loja = p.id_loja)
            WHERE
                i.tabela_imag = :tabela
                AND p.id_seto LIKE :setor
            ORDER BY
                p.id_prod LIMIT 2'
        );

        $grid_xl = 6;
    endif;

    $sql->bindParam(':tabela', $tabela);
    $sql->bindParam(':setor', $setor_final);
    $sql->execute();
    $produtos = $sql->fetchAll();
    $linhas = $sql->rowCount();

    if ($linhas == 0):

        echo "<h5 class='my-4'>Opa, parece que não encontramos produtos nesse setor, verifíque mais tarde. :/</h5>";
    endif;

    foreach ($produtos as $produto):

        if ($produto['promocao_prod'] > 0):

            $preco_final = $produto['preco_prod'] - $produto['promocao_prod'];
            $preco = $produto['preco_prod'];
        else:

            $preco_final = $produto['preco_prod'];
            $preco = '';
        endif;
    ?>

    <div class="col-6 col-sm-6 col-md-4 col-lg-3 col-xl-<?= $grid_xl ?> text-center p-3">
        <a href="produto.php?produto=<?= $produto['id_prod'] ?>">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 bg-white rounded shadow-sm produto position-relative">

                    <div class="imagem rounded">
                        <img class="img miniatura" alt="Responsive image" src="../imagens/<?= $produto['arquivo_imag'] ?>">
                    </div>

                    <div class="titulo">
                        <h3 class="mt-3 mb-0 text-muted"><?= $produto['nome_prod'] ?></h3>
                    </div>

                    <div class="d-none d-lg-block text-right">
                        <h5><span class="badge badge-info"><?= $produto['nome_loja'] ?></span></h5>
                    </div>

                    <hr class="my-0 py-0">

                    <div class="d-inline-block mt-auto align-bottom">
                        <h5 class="mt-2 mb-0 text-dark">R$: <?php echo number_format($preco_final, 2, ",", "."); ?></h5>
                        <h6 class="text-right text-muted font-weight-normal"><s><?= $preco ?></s></h6>
                    </div>

                </div>
            </div>
        </a>
    </div>

<?php endforeach; ?>
