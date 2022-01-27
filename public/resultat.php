<?php 

require __DIR__.'/config.inc.php'; 

$numero = 0;
if(isset($_GET['numero'])) {
    $numero = $_GET['numero'];
}
$numero = sprintf("%03d", $numero);
?>
<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Voeux 2022 du 24ème</title>
        <meta property="og:site_name" content="Voeux 2022 du 24ème">
        <meta content="resultat.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo $numero ?>" property="og:url">
        <meta content="<?php echo str_replace('"', '\"', $title1." ".$title2) ?>" property="og:title">
        <meta content="<?php echo str_replace('"', '\"', $slogan) ?>" property="og:description">
        <meta content="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo $numero ?>" property="og:image">
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
                <div class="text-center mt-4 pt-4">
                    <p id="resultat_loader_msg"></p>
                </div>
                </div>
            </div>
            <div id="resultat_affiche" class="row d-none">
                <div class="col-12">
                <h1 class="text-center"><img src="https://www.24eme.fr/img/24eme.svg" width=75 height=75/></h1>
                </div>
                <div class="col-12 text-center"><img id="image_affiche" class="img-thumbnail" src="" /></div>
                <div class="col-12">
                    <div class="row p-4">
                        <a id="btn_camera" class="col-3 btn btn-default" href="camera.php?csv=<?php echo urlencode($csv) ?>">       «&nbsp;<i class="bi bi-camera-fill"></i></a>
                        <a class="col-6 btn btn-primary" href="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo $numero ?>&format=pdf">Télécharger l'affiche</a>
                        <a id="btn_partager" class="col-3 btn btn-default" href="q.php?<?php echo  $csvId ?>_<?php echo $numero ?>">          <i class="bi bi-share"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <script>
        msg_i = 0;
        msg_txt = ["Affiche en cours<br/>de conception", "L'équipe de communication cherche<br/>la meilleure stratégie", "L'équipe de campagne initie<br/>l'appel d'offre", "Un imprimeur est en passe<br/>d'être trouvé", "L'affiche va être<br/>livrée sous peu", "Une primaire va être lancé<br/>pour choisir votre affiche"];
        var timerLoader = setInterval(function(){msg_i++;msg_points="";for(i=0;i<msg_i % 4;i++){msg_points += '.';} document.querySelector('#resultat_loader_msg').innerHTML = msg_txt[Math.floor(msg_i / 8) % (msg_txt.length)]+msg_points;}, 1000);
        var urlImage = document.querySelector('#image_affiche').src;
        document.querySelector('#image_affiche').src = "affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo $numero ?>";
        document.querySelector('#image_affiche').addEventListener('load', function(event) {
            clearInterval(timerLoader);
            document.querySelector('#resultat_affiche').classList.remove('d-none');
            document.querySelector('#resultat_loader').classList.add('d-none');
        });
        document.querySelector('#btn_partager').addEventListener('click', function(event) {
            event.preventDefault();
          try {
            navigator.share(datashare = {
                url: this.href,
                title: "<?php echo str_replace('"', '\"', $title1." ".$title2) ?>",
                text: "<?php echo str_replace('"', '\"', $slogan) ?>"
            });
        }catch(e) {
            navigator.clipboard.writeText(this.href);
            alert('✔ Le lien pour partager cette affiche a été copié dans le presse papier');
        }
        return false;
        });
        </script>
    </body>
</html>
