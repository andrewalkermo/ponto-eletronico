<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="../../assets/img/projecta-title.png" type="image/png" />
        <title>Ponto - Projecta</title>
        <link rel="stylesheet" href="../../vendor/gainTime-2.2.2/css/gaintime.min.css" media ="screen" title="no title">
        <link rel="stylesheet" href="../../assets/css/stylesheet.css" media ="screen" title="no title">
        <script type="text/javascript" src="../../vendor/gainTime-2.2.2/js/gaintime.min.js"></script>
        <script type="text/javascript" src="../../assets/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../../assets/js/jquery.mask.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
    </head>
    
    <body class="panel">

        <header class="gt-top-menu xs-left">
            <a href="/"><img src="/assets/img/projecta-logo.png" alt="Projecta" /></a>
            <label class="menu-toggle">
                <svg viewBox="0 0 24 24">
                <path fill="#333" d="M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z"></path>
                </svg>
            </label>
            <nav>
                <ul>
                    <a href="/views/painel"><li class="">Painel</li></a>
                    <a href="/views/membros"><li class="">Membros</li></a>
                    <a href="/views/relatorio"><li class="active">Relatórios</li></a>
                    <a href="/"><li class="">Ponto</li></a>

                </ul>
            </nav>
        </header>

        <main>
            <section class="center">
                <div class="title">
                    <h1>Relatórios</h1>
                </div>
                <form class="gt-form center" action="../../controllers/RelatorioController.php" method="post">

                    <div class="center">
                        <div id="divRelatorio">
                            <h3>Selecione o tipo de relatório:</h3>
                            <div  class="flex-box center">
                                <input id="inputRelatorio" type="hidden" name="relatorio[relatorio]" data-validate="" placeholder="" value="">
                                <button type="button" class=" col btn projecta-yellow success" style="text-align:center" onclick="relatorio('#divTipo', 'membros');">Tabela dos membros</button>
                                <button type="button" class=" col btn projecta-black success" style="text-align:center" onclick="relatorio('#divData', 'sede')">Tabela de Sede</button>
                            </div>
                        </div>
                        <div id="divTipo"style="display: none;">
                            <h3>Selecione o tipo:</h3>
                            <div class="flex-box center">
                                <input id="inputTipo" type="hidden" name="relatorio[tipo]" data-validate="" placeholder="" value="">
                                <button type="button" value="" onclick="tipo('#divData', 'sede');" class=" col btn projecta-black success" style="text-align:center">Sede</button>
                                <button type="button" value="" onclick="tipo('#divData', 'projeto');" class=" col btn projecta-yellow success" style="text-align:center">Projeto</button>
                                <button type="button" value="" onclick="tipo('#divData', 'atividade');" class=" col btn projecta-black success" style="text-align:center">Atividade</button>
                            </div>
                        </div>
                        <div id="divData" style="display: none;">
                            <h3>Selecione o interválo de datas:</h3>
                            <div class="gt-form-inline">
                                <input id="startDate" type="text" class="inputDate" name="relatorio[beginDate]" data-validate="" placeholder="Data inicial" value="">
                                <label for="endDate"> - </label>
                                <input id="endDate" type="text" class="inputDate" name="relatorio[endDate]" data-validate="" placeholder="Data final" value="">
                            </div>
                            <div id="weekpicker">
                                <div class="week-picker"></div>
                            </div>
                            <div class="flex-box">

                                <button id="submit" type="submit" class="col btn projecta-black success center" name="action" value="">Gerar relatório</button>

                            </div>
                        </div>

                    </div>
                </form>
            </section>
            <?php include('../includes/footer.inc') ?>

        </main>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
        <script type="text/javascript" src="../../assets/js/datepicker-pt-BR.js"></script>
        <link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css">
        <script type="text/javascript">
            $( ".week-picker" ).hide()

            $('.inputDate').focus(function() {
                $( ".week-picker" ).show()
                $("#footer").css("position", "relative");
            });

            function relatorio(proxDiv, value){
                $('#divRelatorio').hide();
                $(proxDiv).show();
                $('#inputRelatorio').val(value);
                $('#submit').val(value);

            }
            function tipo(proxDiv, value){
                $('#divTipo').hide();
                $(proxDiv).show();
                $('#inputTipo').val(value);

            }
        </script>
        <script type="text/javascript">

            $(function() {
                var startDate;
                var endDate;

                var selectCurrentWeek = function() {
                    window.setTimeout(function () {
                        $('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
                    }, 1);
                }

                $('.week-picker').datepicker( {
                    firstDay: 1,
                    dateFormat: 'dd/mm/yy',
                    autoSize: true,
                    showOtherMonths: true,
                    selectOtherMonths: true,
                    onSelect: function(dateText, inst) {
                        var date = $(this).datepicker('getDate');
                        startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 1);
                        endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 7);
                        var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
                        $('#startDate').val($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
                        $('#endDate').val($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
                        $( ".week-picker" ).hide()
                        $("#footer").css("position", "absolute");
                        selectCurrentWeek();
                    },
                    beforeShowDay: function(date) {
                        var cssClass = '';
                        if(date >= startDate && date <= endDate)
                            cssClass = 'ui-datepicker-current-day';
                        return [true, cssClass];
                    },
                    onChangeMonthYear: function(year, month, inst) {
                        selectCurrentWeek();
                    }
                });

                $('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
                $('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
            });
        </script>

    </body>

</html>
