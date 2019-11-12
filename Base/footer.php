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


<footer class="center grey lighten-4">
    <div class="footer-copyright black-text"><a target="_blank" href="http://markeyvip.com"
                                                class="center col l10 s12 offset-l1 black-text">
            © 2019 Desenvolvido por - MarkeyVip</a>
    </div>
</footer>

<!--Codigo que realiza os loaders-->
<div id="preLoader"
     style="z-index: 214748364; position: fixed; height: 100vh; width: 100vw; background-color: white; opacity: 0.7; ; top: 0; left: 0; display: none;">
    <div style="display: block; position: fixed; left: calc(50% - 32px); top:calc(50% - 32px); opacity: 1;">
        <div class="preloader-wrapper big active">
            <div class="spinner-layer spinner-blue-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="gap-patch">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onbeforeunload = function(){
        $("#preLoader").show();
    };
</script>

<?php
if(isset($_SESSION)){
    if(isset($_SESSION['logado'])){
        include_once __DIR__."/chat2.php";
    }
}
?>

