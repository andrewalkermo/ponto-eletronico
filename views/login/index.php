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
                    <a href="/views/ponto"><li>Ponto</li></a>
                    <a href="/#"><li class="active">Login</li></a>
                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Login!</h1>
                </div>
                <form class="gt-form center" action="/controllers/LoginController.php" method="post">

                    <div class="login-form">

                        <label for="username"class="title"><h3>Login:</h3></label>
                        <input id="username" type="text" name="login[username]" data-validate="text" value="">
                        <label for="password" class="title"><h3>Senha:</h3></label>
                        <input id="password" type="password" name="login[password]" value="">

                        <div class="flex-box">
                            <div class="col">
                            </div>
                            <button type="submit" name="action"  class="col btn success projecta-black" value="login">Entrar</button>
                            <div class="col">
                            </div>
                        </div>

                    </div>

                </form>

            </section>
            <?php include('../includes/footer.inc') ?>

        </main>

        <script type="text/javascript" src="/vendor/gainTime-2.2.2/js/gaintime.min.js"></script>
        <script type="text/javascript">

            function nextDiv(divAtual, divProxima) {
                var divAtual = (document.getElementsByClassName(divAtual))[0];
                var divProxima = (document.getElementsByClassName(divProxima))[0];
                divAtual.setAttribute("style", "display:none");
                divProxima.removeAttribute("style");
            }

        </script>


    </body>

</html>
