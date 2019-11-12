<?php
$pontos = "";
if (realpath("./index.php")) {
    $pontos = './';
} else {
    if (realpath("../index.php")) {
        $pontos = '../';
    } else {
        if (realpath("../../index.php")) {
            $pontos = '../../';
        }
    }
}
?>
<nav class="nav-extended white" style="position: relative;">
    <div class="nav-wrapper" style="margin-left: auto; margin-right: auto;">
        <a href="<?php echo $pontos; ?>index.php" class="brand-logo black-text left initLoader">
        </a>
        <ul class="right">
            <?php if (!isset($_SESSION['logado'])) { ?>
                <li>
                    <a class="black-text modal-trigger" href="<?php echo $pontos ?>Tela/login.php">
                        <div class="chip detalheSuave">
                            Entrar
                        </div>
                    </a>
                </li>
                <li>
                    <a class="black-text modal-trigger hide-on-med-and-down" href="<?php echo $pontos ?>Tela/registroUsuario.php" id="registro">
                        <div class="chip detalheSuave">
                            Registre-se
                        </div>
                    </a>
                </li>
            <?php }else{
                ?><li>
                    <a class="black-text modal-trigger hide-on-med-and-down" href="<?php echo $pontos ?>Controle/usuarioControle.php?function=logout" id="registro">
                        <div class="chip detalheSuave">
                            Sair
                        </div>
                    </a>
                </li><?php
            } ?>
        </ul>
    </div>
</nav>

