<?php
    require_once (__DIR__ . '/../../controllers/MemberController.php');
    $membros = json_encode(MemberController::selectAll());
?>

<!DOCTYPE html>
<html>

    <?php include(__DIR__ . '/../includes/head.inc') ?>

    <body class="panel">

        <header class="gt-top-menu xs-left">
            <img src="/assets/img/projecta-logo.png" alt="Projecta" />
            <label class="menu-toggle">
                <svg viewBox="0 0 24 24">
                <path fill="#333" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
                </svg>
            </label>
            <nav>
                <ul>
                    <a href="#"><li class="active">Ponto</li></a>
<!--                    <a href="/views/painel"><li>ADM Page</li></a>-->
                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Bem vindo!</h1>
                </div>
                <form autocomplete="off" id="form-ponto"  class="gt-form center" action="../../controllers/PointController.php" method="post">

                    <div class="nome-div">
                        <div class="">
                            <label for="name"class="title"><h3>Nome:</h3></label>
                            <input id="fk_members" type="hidden" name="ponto[fk_members]" data-validate="" placeholder="" value="">
                            <div class="autocomplete" style="width:100%;">
                                <input id="name" type="text" name="" data-validate="text" placeholder="Amarelinhx" value="">
                            </div>

                        </div>
                        <div class="flex-box">
                            <div class="col">
                            </div>
                            <button type="button" class="col btn success projecta-black" onclick="nextDiv('nome-div', 'tipo-div')" name="button">Próximo</button>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                    <div class="tipo-div" style="display:none">
                        <h3>Selecione o tipo de ponto!</h3>
                        <div class="flex-box center">
                            <input id="type" type="hidden" name="ponto[type]" class="" data-validate="">
                            <button type="button" class="col btn projecta-yellow success" onclick="setValueOnInputbyButton('type', 'sede');nextDiv('tipo-div', 'periodo-div');" >Hórario de sede</button>
                            <button type="button" class="col btn projecta-black danger" onclick="setValueOnInputbyButton('type', 'projeto');nextDiv('tipo-div', 'periodo-div');" >Trabalho em Projeto</button>
                            <button type="button" class="col btn projecta-yellow success" onclick="setValueOnInputbyButton('type', 'atividade');nextDiv('tipo-div', 'periodo-div');" >Horário em atividades</button>
                        </div>
                    </div>
                    <div class="periodo-div" style="display:none">
                        <h3>Selecione o período!</h3>
                        <div id="aviso-atividade" class="inform warning" style="display: none">
                            <p>Visitas, benchmarking, atividades da sua diretoria... Qualquer tempo dedicado a Projecta sem que você esteja na sede ; )</p>
                        </div>
                        <div class="flex-box center">
                            <input id="period" type="hidden" class="" data-validate="">
                            <button type="button" class="col btn projecta-black warning" name="ponto['begin_time']" value="true" onclick="setNameOnInputbyButton('period', 'ponto[begin_time]');nextDiv('periodo-div', 'horario-div');" >Começo</button>
                            <button type="button" class="col btn projecta-yellow danger" name="ponto['end_time']" value="true" onclick="setNameOnInputbyButton('period', 'ponto[end_time]');nextDiv('periodo-div', 'horario-div');" >Término</button>
                        </div>

                    </div>
                    <div class="horario-div" style="display:none">
                        <div class="">
                            <label for="name"class="title"><h3>Horário:</h3></label>
                            <input id="time" type="text" name="ponto['time']" class="" data-validate="" placeholder="04:20" value="">
                        </div>
                        <div class="flex-box">
                            <div class="col">
                            </div>
                            <button id="submit" type="submit" class="col btn projecta-black success center" name="action" value="" onclick="setValueOnInputbyInput('period', 'time')">Finalizar</button>
                            <div class="col">
                            </div>
                        </div>
                    </div>


                    <input id="membros_array" type="hidden" name="membrosarray" data-validate="" placeholder="" value='<?= $membros;?>'>
                    <input id="submit-input" type="hidden" name="action" data-validate="" placeholder="">
                    <input id="msg" type="hidden" name="msg" data-validate="" placeholder="" value="<?= (isset($_GET['r']) && !empty($_GET['r']) && $_GET['r'] != null) ? ($_GET['r']) : '';?>">

                </form>

            </section>
            <?php include(__DIR__ . '/../includes/footer.inc') ?>
        </main>
        <script type="text/javascript" src="../../assets/js/ponto.js"></script>
    </body>

</html>
