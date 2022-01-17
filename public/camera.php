<?php 

require __DIR__.'/config.inc.php'; 

?>
<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <meta name="mobile-web-app-capable" content="yes">
    </head>
    <body style="margin: 0; padding: 0; overflow-x: hidden;">
        <div style="position: relative; margin: 0; padding: 0; overflow: hidden;">
        <video id="camera" style="margin: 0; padding: 0; width: 100%;" autoplay playsinline></video>
        <img id="photo" src="" style="position: absolute; top: 0; left: 0; margin: 0; padding: 0;" />
        <img id="tenue" src="tenue/<?php echo $tenue ?>" style="width: 150%; position: absolute; bottom: 0; left: -25%; margin: 0; padding: 0;" />
        </div>
        <div class="fixed-bottom bg-light p-2" style="z-index: 9999;">
            <div class="container">
                <div id="block-btn-photo" class="d-grid gap-2">
                    <button id="take" class="btn btn-primary d-block" type="button">Démarrer</button>
                </div>
                <form id="form_camera" action="photo.php?csv=<?php echo $GET['csv'] ?>" method="POST" enctype="multipart/form-data">
                    <div id="block-btn-confirmation" class="d-none row">
                        <div class="d-grid gap-2 col-6">
                            <button id="btn-cancel" class="btn btn-outline-danger" type="button">Recommencer</button>
                        </div>
                        <div class="d-grid gap-2 col-6">
                            <button class="btn btn-success" type="submit">Confirmer</button>
                        </div>
                    </div>
                    <input id="input_camera" name="camera" style="width: 100%; margin: 0; padding: 0; position: fixed; bottom: 20px; display:none;" type="file" />
                </form>
            </div>
        </div>
        <script src="app.js"></script>
    </body>    
</html>
