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
<div class="sideChat z-depth-3" style="display: none">
    <div class="headChat">
        <div class="center-block">Contatos <a href="#!" class="closeChatList"><i
                        class="material-icons right" style="margin-right: 15px;">close</i></a></div>
    </div>
    <div class="bodyChat">
        <div class="row">
            <div class="col s12">
                <ul class="collection">
                    <?php
                    include_once $pontos . "Modelo/Usuario.php";
                    include_once $pontos . "Controle/chatPDO.php";
                    $chatPDO = new chatPDO();
                    $stmt = $chatPDO->selectListaContatos();
                    while ($linha = $stmt->fetch()) {
                        $usuario = new usuario($linha);
                        echo "  <li class='hoverable waves-effect openChat collection-item avatar' id_destinatario='" . $usuario->getId_usuario() . "'>
                                        <img src='". $usuario->getFoto() . "' class='circle'>
                                        <span class='title'>" . $usuario->getNome() . "</span>".($linha['newMessages']==0?"":"<span class='badge corPadrao3 white-text'>".$linha['newMessages']."</span>")."
                                </li>";

                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<form action="#!" id="testeArquivo" method="post" class="hide" enctype="multipart/form-data">
    <div class="row">
        <div class="input-field col s12">
            <input type="file" id="arquivo" name="arquivo">
            <input type="submit">
        </div>
    </div>
</form>
<div class="chatBox z-depth-3" style="display: none;">
    <div class="headChatBox"><span id="nameDestinatario"></span> <a href="#!" class="closeChat"><i
                    class="material-icons right" style="margin-right: 15px;">close</i></a></div>
    <div class="bodyChatBox"></div>
    <div class="horizontal-divider" style="width: 100%"></div>
<!--    <div class="inputChat" style="overflow: auto;">-->
        <form method="post" action="#!" id="formMensagem">
            <div class="row">
                <div class="input-field col s9">
                    <input id="mensagem" name="mensagem" type="text" autocomplete="off">
                    <label for="mensagem">Mensagem</label>
                </div>
                <div class="col s1">
                    <div class="file-field input-field">
                        <a class="btn" href="#!" id="enviaImagem"><i class="material-icons">image</i></a>

                    </div>
                </div>
            </div>
        </form>
</div>
<div class="fixed-action-btn">
    <a class="btn-floating btn-large corPadrao3" id="openChatList" >
        <i class="large material-icons">chat</i>
    </a>
</div>


<script>
    $("#enviaImagem").click(function () {
        $("#arquivo").click();
        carregarFoto();
    });
    function carregarFoto() {
        const s = document.querySelector.bind(document);
        const fileChooser = s('#arquivo');

        fileChooser.onchange = e => {
            const fileToUpload = e.target.files.item(0);
            const reader = new FileReader();
            reader.readAsDataURL(fileToUpload);
            $("#testeArquivo").submit();
        };
    }
    $("#openChatList").click(function () {
        $(".sideChat").show();
        $(this).hide();
    });

    $(".closeChatList").click(function () {
        $("#openChatList").show();
        $(".sideChat").hide();
    });

    var refreshChat;
    var ajax;
    var id_destinatario = 0;
    var x = 0;
    $(".openChat").click(function () {
        var nome = $(this).find($(".title")).html();
        var id = $(this).attr("id_destinatario");
        id_destinatario = id;
        openChat(nome);

    });
    $(".closeChat").click(function () {
        $(".sideChat").show();
        $(".chatBox").hide();
        ajax.abort();
        $(".bodyChatBox").html("");
        $(".bodyChat").load("<?php echo $pontos ?>Controle/chatControle.php?function=refreshBodyChat&pontos=<?php echo $pontos ?>", function () {
            $(".openChat").click(function () {
                var nome = $(this).find($(".title")).html();
                var id = $(this).attr("id_destinatario");
                id_destinatario = id;
                openChat(nome);

            });
        });
    });

    $("#formMensagem").submit(function () {
        var dados = $(this).serialize();
        $("#mensagem").val("");
        $.ajax({
            url: "<?php echo $pontos; ?>Controle/chatControle.php?function=enviaMensagem&destinatario=" + id_destinatario,
            data: dados,
            type: "post",
            success: function (data) {
                //TODO confirmação de envio

            }
        });
        return false;
    });
    $("#testeArquivo").submit(function () {
        var formData = new FormData(this);
        $.ajax({
            url: "<?php echo $pontos; ?>Controle/chatControle.php?function=enviaMedia&destinatario=" + id_destinatario,
            type: 'POST',
            data: formData,
            success: function (data) {
                //TODO reação a envio positivo
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
        return false;
    });

    function openChat(nome_destinatario) {
        x = 0;
        $("#nameDestinatario").html(nome_destinatario);
        $(".sideChat").hide();
        $(".chatBox").show();
        $(".bodyChatBox").load("<?php echo $pontos; ?>Controle/chatControle.php?function=selectConversa&destinatario=" + id_destinatario, startPushListener);
    }

    function intervalo() {
        var lastId = $(".last_id:last").val();
        if(lastId != 'undefined') {
            if (x < 1) {
                $(".bodyChatBox").scrollTop($(".bodyChatBox").height() * 150);
                x++;
                ajax = $.ajax({
                    url: "<?php echo $pontos; ?>Controle/chatControle.php?function=getNewMessage&destinatario=" + id_destinatario + "&last_id=" + lastId,
                    success: function (data) {
                        x--;
                        $(".bodyChatBox").append(data);
                        $(".bodyChatBox").scrollTop($(".bodyChatBox").height() * 150);
                        $(".materialboxed").materialbox();
                    }
                });
            }
        }
    }

    function startPushListener() {
        $(".materialboxed").materialbox();
        $(".bodyChatBox").scrollTop($(".bodyChatBox").height() * 150);
        refreshChat = setInterval(intervalo, 500);
    }
</script>


