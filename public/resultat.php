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
    <body class="pb-3">
        <div class="container pt-2 pb-5">
            <div class="row mb-5">
                <div class="col-md-1 col-lg-2 col-xl-3"></div>
                <div class="col"><img id="image_affiche" class="img-thumbnail" src="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>" /></div>
                <div class="col-md-1 col-lg-2 col-xl-3"></div>
            <div>
        </div>
        <div class="fixed-bottom bg-light">
            <div class="container">
                <div class="row">
                    <div id="block_group_telecharger" class="col-md-6 col-sm-12 pt-2 pb-2">
                        <div class="input-group">
                            <a id="btn-lien" class="btn btn-outline-secondary" href="resultat.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>"><i class="bi bi-link"></i> Lien</a>
                            <a id="btn-image" class="btn btn-outline-secondary" href="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>"><i class="bi bi-card-image"></i> Image</a>
                            <a id="btn-pdf" class="btn btn-outline-secondary" href="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php isset($_GET['numero']) ? $_GET['numero'] : 0 ?>&format=pdf"><i class="bi bi-file-richtext"></i> PDF</a>
                        </div>
                    </div>
                    <div id="block_partager" class="d-grid gap-2 col-md-6 col-sm-12 pb-2 pt-md-2 d-none">
                        <button id="btn_partager" class="btn btn-outline-primary" type="button">Partager</button>
                    </div>
                    <div class="d-grid gap-2 col-md-6 col-sm-12 pb-2 pt-md-2">
                        <a class="btn btn-primary" href="affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>&format=pdf">Télécharger</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
        if(navigator.share) {
            document.querySelector('#block_partager').classList.remove('dt-none');
        }
        document.querySelector('#btn-lien').addEventListener('click', function(event) {
            navigator.clipboard.writeText(this.href);
            event.preventDefault();
            alert('Lien copié dans le presse papier');
            return false;
        })
        document.querySelector('#btn_partager').addEventListener('click', function(event) {
            navigator.share({
                url: 'affiche.php?csv=<?php echo urlencode($csv) ?>&numero=<?php echo isset($_GET['numero']) ? $_GET['numero'] : 0 ?>',
                title: '',
                text: '',
            })
        });
        </script>
    </body>
</html>
