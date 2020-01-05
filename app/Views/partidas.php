<?php
/*show_array($matches);*/

?>
<style>

    body{
        background: rgba(245, 245, 245, 1);
    }
    .image {
        background-image: url('https://images.unsplash.com/photo-1560272564-c83b66b1ad12?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=687&q=80');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        position: relative;
        height: auto;
    }
    .image:before{
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        bottom: 0;
        background: rgba(0,0,0,0.5);
    }

</style>
<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4"><?php
            if (empty($matches)) {
                echo "<h1>Não Há partidas para esta liga...</h1>";
            } else {
                echo $matches[0]['nome_liga'];
            }; ?>
        </h1>
        <p class="lead">Os melhores jogos e probalidades estão aqui!</p>
        <hr>
        <div class="text-center mt-5">

        </div>
    </div>
</div>



<?php

foreach ($matches as $jogo){ ?>

    <section class=" bg-white pb-3 shadow-sm mb-4">
        <div class="row text-center py-3 image text-white" >
            <div class="col">
                <img class="img-fluid" src="<?= base_url('assets/img/logos/brasil/soccer/') . urlTitle($jogo['time_casa_nome']).".png"; ?>" alt="">
                <br>
                <?= $jogo['time_casa_nome'] ?>
            </div>

            <div class="col">
                <span style="font-size: 2rem "><i class="far fa-times-circle"></i></span>
                <br>
                Empate
            </div>

            <div class="col">
                <img class="img-fluid" src="<?= base_url('assets/img/logos/brasil/soccer/') . urlTitle($jogo['time_visitante_nome']).".png"; ?>" alt="">
                <br>
                <?= $jogo['time_visitante_nome'] ?>
            </div>
        </div>

        <div class="row  p-4">
            <div class="col">
                <span >Bolão:</span>
            </div>
            <div class="col">
                <span >R$ por cota:</span>
            </div>
        </div>
        <div class="row text-center px-2">
            <div class="col" data-partida=" <?= $jogo['id_jogo'] ?>" data-opcao="<?= $jogo['time_casa_nome'] ?>" >
                <button class="btn btn-info btn-block opcao" type="submit"  ><?= $jogo['time_casa_nome'] ?></button>
            </div>
            <div class="col" data-partida=" <?= $jogo['id_jogo'] ?>" data-opcao="empate">
                <button class="btn btn-warning btn-block opcao" type="submit"  >Empate</button>
            </div>
            <div class="col" data-partida="<?= $jogo['id_jogo'] ?>" data-opcao="<?= $jogo['time_visitante_nome'] ?>">
                <button class="btn btn-success btn-block opcao" type="submit"  ><?= $jogo['time_visitante_nome'] ?></button>
            </div>
        </div>
    </section>


<?php } ?>


<div class="   " id="modal" tabindex="-1" role="dialog"   aria-labelledby="TituloModalCentralizado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Flamengo vs Vasco <br><span style="font-size:16px"><?= date("d-m-Y H:i"); ?></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row text-center py-3">
                    <div class="col">
                        <p>Resultado Escolhido</p>
                        <p class="resultadoEscolhido"> </p>
                    </div>
                    <div class="col">
                        <h4 class="text-center">Sua Premiação</h4>
                    </div>
                </div>

                <div class="form-group">
                    <input style="height: 50px" inputmode="numeric" pattern="[0-9]*" type="number" class="form-control" placeholder="Valor mínimo R$ 5,00" name="<?php ['time_casa']; ?>" id="investiment">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="calcular">Calcular Prêmio</button>
                <button type="button" class="btn btn-success">Salvar</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        $('.close').click(function (e) {
            e.preventDefault();
            $('#investiment').val('');

        });

        $(document).on('click', '.opcao', function (e) {
            e.preventDefault;

            var opcao = $(this).closest('.col').data('opcao');
            var jogo = $(this).closest('.col').data('partida');
            var escolha = {idJogo: jogo, opcao: opcao};

            $('.resultadoEscolhido').text(opcao);


            console.log(escolha);
        });

        $('#calcular').click(function (e) {
            e.preventDefault();
            let investimento = $("#investiment").val();
            if (investimento < 5 || investimento.length == 0 ){
                alert('O valor tem que ser maior que R$ 5,00');
                return false;
            }
        });
    });
</script>