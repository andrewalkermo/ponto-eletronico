<!DOCTYPE html>
<html>

    <?php include('../includes/head.inc') ?>

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
                    <a href="/#"><li class="active">Painel</li></a>
                    <a href="/views/ponto"><li>Logout</li></a>
                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Painel</h1>
                </div>

                <div class="tipo-div gt-form center" >
                    <h3>Selecione o que deseja fazer</h3>
                    <div class="flex-box center">
                        <button type="button" class="col btn projecta-yellow success" name="button">Membros</button>
                        <button type="button" class="col btn projecta-black danger" name="button">Horários</button>
                        <button type="button" class="col btn projecta-yellow success" name="button">Relatórios</button>
                    </div>
                </div>

            </section>
        </main>

        <script type="text/javascript" src="/vendor/gainTime-2.2.2/js/gaintime.min.js"></script>
        <?php include('../includes/footer.inc') ?>
    </body>

</html>
