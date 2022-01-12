<?php 

$args = [
    'qrcode' => FILTER_SANITIZE_STRING
];

$GET = filter_input_array(INPUT_GET, $args);
$qrcode = $GET['qrcode']; 

if(!$qrcode) {
    echo "Aucun qrcode n'a été renseigné";
    exit(1);
}

?>
<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body style="margin: 0; padding: 0;">
        <div style="position: relative; margin: 0; padding: 0;">
        <video id="camera" style="position: absolute; top: 0; left: 0; margin: 0; padding: 0; width: 100%;"></video>
        <img id="photo" src="" style="position: absolute; top: 0; left: 0; margin: 0; padding: 0;" />
        <img src="tenues/costard.png" style="width: 100%; position: absolute; top: 20px; left: 0; margin: 0; padding: 0;" />
        </div>
        <button id="take" style="width: 100%; margin: 0; padding: 0; position: fixed; bottom: 0;">Prendre la photo</button>
        <div id="errorMsg"></div>
        <form id="form_camera" action="photo.php?qrcode=<?php echo $qrcode ?>" method="POST" enctype="multipart/form-data">
            <input id="input_camera" name="camera" style="width: 100%; margin: 0; padding: 0; position: fixed; bottom: 20px;" type="file" />
        </form>
        <script src="app.js"></script>
    </body>    
</html>
