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
    </head>
    <body>
        <div class="container pt-2 pb-2">
            <div id="resultat_loader">
                <div class="row">
                <div class="col-12">
                <h1 class="text-center"><img src="https://www.24eme.fr/img/24eme.svg" width=75 height=75/></h1>
                </div>
                </div>
                <div class="row">
                <div class="text-center">
                    <p id="resultat_loader_msg">Affiche en cours de conception</p>
                </div>
                </div>
            </div>
            <div id="resultat_affiche" class="row" style="display: none;">
                <div class="col-12">
                <h1 class="text-center"><img src="https://www.24eme.fr/img/24eme.svg" width=75 height=75/></h1>
                </div>
                <div class="col-12"><img id="image_affiche" class="img-thumbnail" src="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php isset($_GET['numero']) ? $_GET['numero'] : 0 ?>" /></div>
                <div class="col-12">
                    <div class="row p-4">
                        <a class="col-3 btn btn-default" href="camera.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>">       «&nbsp;<i class="bi bi-camera-fill"></i></a>
                        <a class="col-6 btn btn-primary" href="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php isset($_GET['numero']) ? $_GET['numero'] : 0 ?>&format=pdf">Télécharger l'affiche</a>
                        <a class="col-3 btn btn-default" href="resultat.php?csv=<?php echo urlencode($csv) ?>&numero=<?php isset($_GET['numero']) ? $_GET['numero'] : 0 ?>">          <i class="bi bi-share"></i></a>
                    </div>
                </div>
        </div>
        <script>
        msg_i = 0;
        msg_txt = ["Affiche en cours de conception", "L'équipe de communication cherche la meilleure stratégie", "L'équipe de campagne initie l'appel d'offre", "Un imprimeur est en passe d'être trouvé", "L'affiche va être livrée sous peu", "Un primaire va être lancé pour choisir votre affiche"];
        setInterval(function(){msg_i++;msg_points="";for(i=0;i<msg_i % 4;i++){msg_points += '.';} document.querySelector('#resultat_loader_msg').innerHTML = msg_txt[Math.floor(msg_i / 8) % (msg_txt.length)]+msg_points;}, 1000);
        document.querySelector('#image_affiche').addEventListener('load', function(event) {
            document.querySelector('#resultat_affiche').style.display = 'block';
            document.querySelector('#resultat_loader').style.display = 'none';
        });
        </script>
    </body>
</html>
