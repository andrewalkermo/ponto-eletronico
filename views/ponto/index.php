<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="/assets/img/projecta-title.png" type="image/png" />
        <title>Ponto - Projecta </title>
        <link rel="stylesheet" href="/vendors/gainTime-2.2.2/css/gaintime.min.css" media ="screen" title="no title">
        <link rel="stylesheet" href="/assets/css/stylesheet.css" media ="screen" title="no title">
    </head>

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
                    <a href="/#"><li class="active">Ponto</li></a>
                    <a href="/#"><li>Login</li></a>
                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Bem vindo!</h1>
                </div>
                <form class="gt-form center" action="myAction" method="post">

                    <div class="nome-div">
                        <div class="">
                            <label for="name"class="title"><h3>Nome:</h3></label>
                            <input id="name" type="text" name="nome" class="" data-validate="text" value="">
                        </div>
                        <div class="gt-form">
                            <button type="button"class="btn success center" onclick="nextDiv('nome-div', 'tipo-div')" name="button">Próximo</button>
                        </div>
                    </div>
                    <div class="tipo-div" style="display:none">
                        <h3>Selecione o tipo de ponto!</h3>
                        <div class="flex-box center">
                            <button type="button" class="col btn warning" name="button" onclick="nextDiv('tipo-div', 'periodo-div')" >Hórario de sede</button>
                            <button type="button" class="col btn danger" name="button" onclick="nextDiv('tipo-div', 'periodo-div')" >Trabalho em Projeto</button>
                            <button type="button" class="col btn success" name="button" onclick="nextDiv('tipo-div', 'periodo-div')" >Horário em atividades</button>
                        </div>
                    </div>
                    <div class="periodo-div" style="display:none">
                        <h3>Selecione o período!</h3>
                        <div class="flex-box center">
                            <button type="button" class="col btn warning" name="button" onclick="nextDiv('periodo-div', 'horario-div')" >Começo</button>
                            <button type="button" class="col btn danger" name="button" onclick="nextDiv('periodo-div', 'horario-div')" >Término</button>
                        </div>
                    </div>
                    <div class="horario-div" style="display:none">
                        <div class="">
                            <label for="name"class="title"><h3>Horário:</h3></label>
                            <input id="name" type="text" name="nome" class="" data-validate="text" value="">
                        </div>
                        <div class="gt-form">
                            <button type="button"class="btn success center" name="button">Finalizar</button>
                        </div>
                    </div>

                </form>

            </section>
        </main>

        <script type="text/javascript" src="/vendors/gainTime-2.2.2/js/gaintime.min.js"></script>
        <script type="text/javascript">
        
            function nextDiv(divAtual, divProxima) {
                var divAtual = (document.getElementsByClassName(divAtual))[0];
                var divProxima = (document.getElementsByClassName(divProxima))[0];
                divAtual.setAttribute("style", "display:none");
                divProxima.removeAttribute("style");
            }

        </script>
        <footer id="footer" class="dark">
                <div class="center">
                    <img class="center" src="/assets/img/projecta-footer.png" alt="">
                </div>
        </footer>
    </body>

</html>
