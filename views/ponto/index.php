<?php
    require_once (__DIR__ . '/../../controllers/MemberController.php');
    $membros = json_encode(MemberController::selectAll());
?>

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
                <form autocomplete="off"   class="gt-form center" action="../../controllers/PointController.php" method="post">

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

                </form>

            </section>
        </main>

        <script type="text/javascript">


            $("#time").mask("99:99");

            var membros = (<?= $membros;?>);
            var msg = <?= (isset($_GET['r']) && !empty($_GET['r']) && $_GET['r'] != null) ? ( '\'' . $_GET['r'] . '\'' ) : '\'\'';?>;

            if(msg != '' && msg != 'null'){
                swal({
                    icon: "success",
                    button: false,
                    text: "Você bateu o ponto com o horário: "  + msg,

                });


                setTimeout(function () {
                    swal.close();
                    window.location='.';
                }, 2000);

            }
            else if(msg == 'null'){
                swal({
                    icon: "error",
                    button: false,
                    text: "Erro ao tentar bater o ponto",

                });


                setTimeout(function () {
                    swal.close();
                    window.location='.';
                }, 2000);

            }

            function nextDiv(divAtual, divProxima) {

                if(divProxima == 'horario-div' && $("#type").val() == 'sede'){
                    var time = new Date();
                    $("#time").val((time.getHours() + ":" + time.getMinutes()));
                    return $("#submit").click();

                }
                if(divProxima == 'periodo-div' && $("#type").val() == 'atividade'){
                    $("#aviso-atividade").show();

                }
                if(divProxima == 'tipo-div') {
                    var id = String($("#fk_members").val());
                    var url = "../../controllers/PointController.php?id=1";
                    /*$.ajax({
                        url: url,
                        dataType: "json",
                        type: "GET",
                        async: false,
                        contentType: "application/json; charset=utf-8",
                        success: function (data) {
                            if(data.success){

                            }
                        }
                    })*/
                }

                var divAtual = (document.getElementsByClassName(divAtual))[0];
                var divProxima = (document.getElementsByClassName(divProxima))[0];

                divAtual.setAttribute("style", "display:none");
                divProxima.removeAttribute("style");

            }

            function setValueOnInputbyButton(input, value) {
                var input = (document.getElementById(input));
                input.setAttribute("value",value);
            }

            function setNameOnInputbyButton(input, value) {
                var input = (document.getElementById(input));
                input.setAttribute("name", value);
                if (value == 'ponto[begin_time]'){
                    $("#submit").val('create');
                    console.log(input);
                }
                else if(value == 'ponto[end_time]'){
                    $("#submit").val('update');
                }

            }

            function setValueOnInputbyInput(input, input2) {
                var input = (document.getElementById(input));
                var input2 = (document.getElementById(input2));
                input.value = input2.value;
                input2.removeAttribute("name");
            }

            autocomplete(document.getElementById("name"), membros);

            function autocomplete(inp, arr) {
                /*the autocomplete function takes two arguments,
                the text field element and an array of possible autocompleted values:*/
                var currentFocus;
                /*execute a function when someone writes in the text field:*/
                inp.addEventListener("input", function(e) {
                    var a, b, i, val = this.value;
                    /*close any already open lists of autocompleted values*/
                    closeAllLists();
                    if (!val) { return false;}
                    currentFocus = -1;
                    /*create a DIV element that will contain the items (values):*/
                    a = document.createElement("DIV");
                    a.setAttribute("id", this.id + "autocomplete-list");
                    a.setAttribute("class", "autocomplete-items");
                    /*append the DIV element as a child of the autocomplete container:*/
                    this.parentNode.appendChild(a);
                    /*for each item in the array...*/
                    for (i = 0; i < arr.length; i++) {
                        /*check if the item starts with the same letters as the text field value:*/
                        if (arr[i].name.substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                            /*create a DIV element for each matching element:*/
                            b = document.createElement("DIV");
                            /*make the matching letters bold:*/
                            b.innerHTML = "<strong>" + arr[i].name.substr(0, val.length) + "</strong>";
                            b.innerHTML += arr[i].name.substr(val.length);
                            /*insert a input field that will hold the current array item's value:*/
                            b.innerHTML += "<input type='hidden' value='" + arr[i].name + "'>";
                            b.innerHTML += "<input type='hidden' value='" + arr[i].id_member + "'>";
                            /*execute a function when someone clicks on the item value (DIV element):*/
                            b.addEventListener("click", function(e) {
                                /*insert the value for the autocomplete text field:*/
                                inp.value = this.getElementsByTagName("input")[0].value;
                                $("#fk_members").val(this.getElementsByTagName("input")[1].value);

                                /*close the list of autocompleted values,
                                (or any other open lists of autocompleted values:*/
                                closeAllLists();
                            });
                            a.appendChild(b);
                        }
                    }
                });
                /*execute a function presses a key on the keyboard:*/
                inp.addEventListener("keydown", function(e) {
                    var x = document.getElementById(this.id + "autocomplete-list");
                    if (x) x = x.getElementsByTagName("div");
                    if (e.keyCode == 40) {
                        /*If the arrow DOWN key is pressed,
                        increase the currentFocus variable:*/
                        currentFocus++;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 38) { //up
                        /*If the arrow UP key is pressed,
                        decrease the currentFocus variable:*/
                        currentFocus--;
                        /*and and make the current item more visible:*/
                        addActive(x);
                    } else if (e.keyCode == 13) {
                        /*If the ENTER key is pressed, prevent the form from being submitted,*/
                        e.preventDefault();
                        if (currentFocus > -1) {
                            /*and simulate a click on the "active" item:*/
                            if (x) x[currentFocus].click();
                        }
                    }
                });
                function addActive(x) {
                    /*a function to classify an item as "active":*/
                    if (!x) return false;
                    /*start by removing the "active" class on all items:*/
                    removeActive(x);
                    if (currentFocus >= x.length) currentFocus = 0;
                    if (currentFocus < 0) currentFocus = (x.length - 1);
                    /*add class "autocomplete-active":*/
                    x[currentFocus].classList.add("autocomplete-active");
                }
                function removeActive(x) {
                    /*a function to remove the "active" class from all autocomplete items:*/
                    for (var i = 0; i < x.length; i++) {
                        x[i].classList.remove("autocomplete-active");
                    }
                }
                function closeAllLists(elmnt) {
                    /*close all autocomplete lists in the document,
                    except the one passed as an argument:*/
                    var x = document.getElementsByClassName("autocomplete-items");
                    for (var i = 0; i < x.length; i++) {
                        if (elmnt != x[i] && elmnt != inp) {
                            x[i].parentNode.removeChild(x[i]);
                        }
                    }
                }
                /*execute a function when someone clicks in the document:*/
                document.addEventListener("click", function (e) {
                    closeAllLists(e.target);
                });
            }

        </script>
        <!--        <script type="text/javascript" src="/vendor/gainTime-2.2.2/js/gaintime.min.js"></script>-->
        <?php include('../includes/footer.inc') ?>
    </body>

</html>
