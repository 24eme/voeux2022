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
            <div class="row">
                <div class="col-md-1 col-lg-2 col-xl-3"></div>
                <div class="col"><img id="image_affiche" class="img-thumbnail" src="affiche.php?csv=<?php echo urlencode($csv) ?>" /></div>
                <div class="col-md-1 col-lg-2 col-xl-3"></div>
        </div>
    </body>
</html>
