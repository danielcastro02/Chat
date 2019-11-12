<?php
//Define em que nivel de pasta estamos para fazer include de qualquer lugar
$pontos = "";
if(!isset($_SESSION)){
    session_start();
}
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
//numeruzinho da versão pra att o cache
$numeruzinho = 2;
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="stylesheet" href="<?php echo $pontos; ?>css/materialize.css?v=<?php echo $numeruzinho; ?>">
<link rel="stylesheet" href="<?php echo $pontos; ?>css/custom.css?v=<?php echo $numeruzinho; ?>">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script type="text/javascript" src="<?php echo $pontos; ?>js/jquery-3.3.1.min.js?v=<?php echo $numeruzinho; ?>"></script>
<script type="text/javascript" src="<?php echo $pontos; ?>js/materialize.js?v=<?php echo $numeruzinho; ?>"></script>
