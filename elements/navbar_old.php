<!-- Início da barra de navegação -->
<div class="navbar navbar-inverse navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container-fluid">

            <a class="brand" href="#"><img src="images/logo_qualilog.png"></a>

            <div class="nav-collapse collapse">
            
                <ul class="nav">
                    <?php 
                        //print_r($_COOKIE);
                        //echo ("Então:" . $nomeCookie);
                        /*
                        $nomeCookie = $_COOKIE['nome'];
                        $emailCookie = $_COOKIE['email'];
                        $senhaCookie = $_COOKIE['senha'];
                        $nivelCookie = $_COOKIE['nivel'];

                        if ($nomeCookie == 'anonymous' || $nomeCookie == ''){  
                            //echo("Teste 1");
                        }else{ */?>
                        
                            <li class="active"><a href="index.php" title="Página inicial">Home</a></li>

                            <?php if ($nivelCookie == '1'){?>
                                <li class="active"><a href="cadastraEmbaixador.php" title="Cadastro de Embaixador">Cadastros</a></li>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        Listas
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="listaEmbaixador.php" role="menuitem">Administradores</a></li>
                                        <li><a href="listaEmbaixador.php" role="menuitem">Super Embaixadores</a></li>
                                        <li><a href="listaEmbaixador.php" role="menuitem">Embaixadores</a></li>
                                        <li><a href="listaEmbaixador.php" role="menuitem">Financeiro</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        SMSr
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="envio_personalizado.php" role="menuitem">Envio Personalizado</a></li>
                                        <li><a href="" role="menuitem">Envio Automático</a></li>
                                        <li class="divider"></li>
                                        <li><a href="" role="menuitem">Consulta de Envios</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        Embaixador
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="agenda.php" role="menuitem" title="Agenda">Agenda</a></li>
                                        <li><a href="index.php" role="menuitem" title="Página inicial">Mural</a></li>
                                        <li><a href="index.php" role="menuitem" title="Página inicial">Ranking</a></li>
                                    </ul>
                                </li>
                            <?php } else if ($nivelCookie == '3') { ?>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        Embaixador
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="agenda.php" role="menuitem" title="Agenda">Agenda</a></li>
                                        <li><a href="index.php" role="menuitem" title="Página inicial">Mural</a></li>
                                        <li><a href="index.php" role="menuitem" title="Página inicial">Ranking</a></li>
                                    </ul>
                                </li>
                            <?php } else if ($nivelCookie == '4') { ?>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        SMSr
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="envio_personalizado.php" role="menuitem">Envio Personalizado</a></li>
                                        <li><a href="" role="menuitem">Envio Automático</a></li>
                                        <li class="divider"></li>
                                        <li><a href="" role="menuitem">Consulta de Envios</a></li>
                                    </ul>
                                </li>

                           <?php /*}*/?>
                        <?php }?>
                </ul>

                <ul class="nav pull-right">
                        <?php
                            //print_r($_COOKIE);
                            //echo ("Então:" . $nomeCookie);
                            if ($nomeCookie == 'anonymous' || $nomeCookie == ''){     
                                ?>
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle='dropdown'>
                                        <?php
                                        /*
                                            $logado = $_GET[$logado];
                                            if ( $logado == 'erro'){
                                                echo ("Login ou Senha incorretas");
                                            }else{
                                                echo ("Login");
                                            }
                                        */
                                        ?>
                                        
                                        <strong class="caret"></strong>
                                    </a>
                                    <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                        <form name="login" id="login" action="php/getLogin.php?acao=logar" method="post">
                                            <input type="email" id="txtEmail" name="txtEmail" placeholder="e-mail">
                                            <input type="password" id="txtPassword" name="txtPassword" placeholder="senha">
                                            <input type="checkbox" id="chkLembrar" name="chkLembrar" value="1">
                                            <label for="chkLembrar">Continuar Conectado</label>

                                            <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px;" type="submit" name="commit" value="Login">
                                        </form>
                                    </div>
                                </li>
                        <?php } else { ?>
                                <li class="dropdown">
                                    <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                        <?php
                                            $nomeCookie = $_COOKIE['nome'];
                                            $idCookie = $_COOKIE['id'];
                                            echo ("Bem Vindo, ".$nomeCookie);
                                        ?>
                                        <strong class="caret"></strong></b>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" arialabledy="">
                                        <li><a href="" role="menuitem">Meu Perfil</a></li>
                                        <li class="divider"></li>
                                        <li><a href="php/getLogout.php" role="menuitem">Log Out</a></li>
                                    </ul>
                                </li>
                        <?php } ?>
                    </ul>

            </div>

        </div>

    </div>

</div>

