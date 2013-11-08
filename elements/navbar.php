<!-- Início da barra de navegação -->
<div class="navbar navbar-inverse navbar-fixed-top">

    <div class="navbar-inner">

        <div class="container-fluid">

            <a class="brand" href="#"><img src="images/logo_qualilog.png"></a>

            <div class="nav-collapse collapse">
            
                <ul class="nav">
                    <li class="active"><a href="index.php" title="Página inicial">Home</a></li>

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
                </ul>

                <ul class="nav pull-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle='dropdown'>
                                Login
                                <strong class="caret"></strong>
                            </a>
                            <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                                <form method="post">
                                    <input type="email" id="txtEmail" name="txtEmail" placeholder="e-mail">
                                    <input type="password" id="txtEmail" name="txtEmail" placeholder="senha">
                                    <input type="checkbox" id="chkLembrar" name="chkLembrar" value="1">
                                    <label for="chkLembrar">Continuar Conectado</label>

                                    <input class="btn btn-primary" style="clear: left; width: 100%; height: 32px;" type="submit" name="commit" value="Login">
                                </form>
                            </div>
                        </li>

                        <li class="dropdown">
                            <a id="" href="" class="dropdown-toggle" data-toggle='dropdown'>
                                Bem Vindo, Usuário
                                 <strong class="caret"></strong></b>
                            </a>
                            <ul class="dropdown-menu" role="menu" arialabledy="">
                                <li><a href="" role="menuitem">Meu Perfil</a></li>
                                <li class="divider"></li>
                                <li><a href="" role="menuitem">Log Out</a></li>
                            </ul>
                        </li>

                </ul>

            </div>

        </div>

    </div>

</div>

