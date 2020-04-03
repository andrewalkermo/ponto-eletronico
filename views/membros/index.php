<?php
require_once('../../controllers/MemberController.php');
$members = MemberController::selectAll();
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
                    <a href="/painel"><li class="">Painel</li></a>
                    <a href="/#"><li class="active">Membros</li></a>
                    <a href="/relatorio"><li class="">Relatórios</li></a>
                    <a href="/ponto"><li class="">Ponto</li></a>

                </ul>
            </nav>
        </header>

        <main>
            <section class="center" style="max-height: 500px;overflow-y: auto;">

                <div class="title">
                    <h1>Painel</h1>
                </div>

                <div class="center">
                    <div class=" row">
                        <div class="xs-8">
                            <h3>Membros</h3>
                        </div>
                        <div class="xs-4 text-right">
                            <button class="btn projecta-yellow success" style="text-align:center" data-modal="createMember">Novo</button>

                        </div>
                    </div>

                    <table class="gt-table striped hovered">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Opções</th>
                            </tr>
                        </thead>

                        <tbody class="text-center">
                        <?php foreach ($members as $key => $member): ?>

                            <tr>
                                <td>
                                    <?= $member->name; ?>
                                </td>
                                <!-- <td><div class="bar" data-percentage="80%"></div></td> -->
                                <td>
                                    <a href="<?= ('../../controllers/MemberController.php?delete=' . $member->id_member);?>" class="action danger" title="Delete"><i class="fa fa-trash"></i> <span>Excluir</span></a>
                                    <a class="action info" title="Edit Page" data-modal="updateMember" onclick="setValueOnInput('<?= $member->id_member; ?>','<?= $member->name; ?>');" ><i class="fa fa-edit"></i> <span>Editar</span></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-right">
                                    Disseminar Uma Arquitetura Transformadora!
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="gt-modal">
                        <div id="createMember" class="modal">
                            <!-- Este botão é responsável por fechar o modal -->
                            <button class="modal-close" type="button">×</button>
                            <div class="modal-body">
                                <div class="center">
                                    <div class="title">
                                        <h1>Adicionar membro</h1>
                                    </div>
                                    <form class="gt-form" action="../../controllers/MemberController.php" method="post">
                                        <label for="name">Nome:</label>
                                        <input id="name" name="membro[name]" type="text">
                                        <div class="flex-box">
                                            <div class="col">
                                            </div>
                                            <button type="submit" class="col btn projecta-black success center" name="action" value="create">Adicionar</button>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gt-modal">
                        <div id="updateMember" class="modal">
                            <!-- Este botão é responsável por fechar o modal -->
                            <button class="modal-close" type="button">×</button>
                            <div class="modal-body">
                                <div class="center">
                                    <div class="title">
                                        <h1>Editar membro</h1>
                                    </div>
                                    <form class="gt-form" action="../../controllers/MemberController.php" method="post">
                                        <label for="updateName">Nome:</label>
                                        <input id="updateId" name="membro[id_member]" type="hidden" value="">
                                        <input id="updateName" name="membro[name]" type="text" value="">
                                        <div class="flex-box">
                                            <div class="col">
                                            </div>
                                            <button type="submit" class="col btn projecta-black success center" name="action" value="update">Salvar</button>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </section>
            <?php include('../includes/footer.inc') ?>

        </main>

        <script type="text/javascript">
            // $("#footer").css("position", "relative");
            function setValueOnInput(id, name) {
                $("#updateId").val(id);
                $("#updateName").val(name);
            }
        </script>
    </body>

</html>
