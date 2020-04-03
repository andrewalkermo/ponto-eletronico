<?php
require_once('../../controllers/PointController.php');
date_default_timezone_set('America/Bahia');
/*SELECT members.name as nome , point.begin_time as inicio , timediff(now(), point.begin_datetime) as duracao FROM point

JOIN members on point.fk_members = members.id_member
where `begin_datetime` BETWEEN (DATE_SUB(NOW(), INTERVAL 12 HOUR)) AND (now())
AND `type` = "sede"
AND `end_datetime` IS NULL
ORDER BY `begin_datetime` DESC
*/
$horario = new DateTime();

$horarioAtual = $horario->format('Y-m-d H:i:s');
$horario = $horario->modify('-12 hour');
$horarioInicio = $horario->format('Y-m-d H:i:s');
$members = PointController::queryAll('SELECT members.name as nome , point.begin_time as inicio , TIME_FORMAT(timediff("'.$horarioAtual.'", point.begin_datetime),"%H:%i:%s") as duracao FROM point 
                JOIN members on point.fk_members = members.id_member
                where `begin_datetime` BETWEEN ("'.$horarioInicio.'") AND ("'.$horarioAtual.'") 
                AND `type` = "sede"
                AND `end_datetime` IS NULL 
                ORDER BY `begin_datetime` DESC
            ');
if ($members == null) {
    $members = [0 => (object) ['nome'=>'Não há ninguém na sede.', 'inicio'=>'00:00', 'duracao'=>'00:00']];
}
$_GET['key']=null;
?>

<!DOCTYPE html>
<html>

<?php include(__DIR__ . '/../includes/head.inc') ?>


<body class="panel">

<header class="gt-top-menu xs-left">
    <a href="/"><img src="../../assets/img/clock.png" alt="Ponto" /></a>
    <label class="menu-toggle">
        <svg viewBox="0 0 24 24">
            <path fill="#333" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
        </svg>
    </label>
    <nav>
        <ul>
            <a href="/#"><li class="active">Painel</li></a>
            <a href="/membros"><li class="">Membros</li></a>
            <a href="/relatorio"><li class="">Relatórios</li></a>
            <a href="/"><li class="">Ponto</li></a>

        </ul>
    </nav>
</header>

<main>
    <section class="center">
        <div class="title">
            <h1>Painel</h1>
        </div>

        <div class="tipo-div gt-form center" >
            <h3>Selecione o que deseja fazer.</h3>
            <div class="flex-box center">
                <a href="/membros" class="col btn projecta-yellow success" style="text-align:center">Membros</a>
                <a href="/relatorio" data-modal="" class="col btn projecta-black success" style="text-align:center">Relatórios</a>
            </div>
            <br>
            <br>
            <div class="membros-na-sede" style="max-height: 400px;overflow-y: auto;">
                <h3 style="text-align: center">Quem está na sede agora.</h3>
                <br>
                <table class="gt-table striped hovered">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Horário de entrada</th>
                        <th>Duração</th>
                    </tr>
                    </thead>

                    <tbody class="text-center">
                    <?php foreach ($members as $key => $member): ?>

                        <tr>
                            <td>
                                <?= $member->nome; ?>
                            </td>
                            <td>
                                <?= $member->inicio; ?>
                            </td>
                            <td>
                                <?= $member->duracao; ?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="4" class="text-right">
                            Pontos batidos a mais de 12 horas atrás serão ignorados.
                        </td>
                    </tr>
                    </tfoot>
                </table>
                <br>
            </div>

            <div class="gt-modal">
                <div id="modal-relatorio" class="modal">
                    <button class="modal-close" type="button">x</button>

                    <div class="modal-header">
                        <h3>Gerar Relatório</h3>
                    </div>
                    <div class="modal-body">
                        <div id="divRelatorio" class="flex-box center">
                            <button class=" col btn projecta-yellow success" style="text-align:center" onclick="relatorio('#divTipo', 'membros');">Tabela dos membros</button>
                            <button class=" col btn projecta-black success" style="text-align:center" onclick="relatorio('#divData', 'sede')">Tabela de Sede</button>
                        </div>
                        <div id="divTipo"style="display: none;">
                            <label>Selecione o tipo:</label>
                            <div class="flex-box center">
                                <button class=" col btn projecta-yellow success" style="text-align:center">Sede</button>
                                <button class=" col btn projecta-black success" style="text-align:center">Projeto</button>
                                <button class=" col btn projecta-black success" style="text-align:center">Atividade</button>

                            </div>
                        </div>
                        <div id="divData" style="display: none;">
                            <label>Selecione o interválo de datas:</label>
                            <div class="gt-form-inline">
                                <input id="startDate" type="text" class="" name="relatorio[beginDate]" data-validate="" placeholder="Data inicial" value="">
                                <label for="endDate"> - </label>
                                <input id="endDate" type="text" class="" name="relatorio[endDate]" data-validate="" placeholder="Data final" value="">
                            </div>
                            <div class="week-picker"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </section>
    <?php include('../includes/footer.inc') ?>

</main>

</body>

</html>
