<?php 
require __DIR__.'/config.inc.php'; 

$args = [
    'csv' => FILTER_SANITIZE_STRING
];
$GET = filter_input_array(INPUT_GET, $args);

?>
<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
            .btn-check:checked + label.btn-radio-image, .btn-check:checked + label.btn-radio-image:active {
                opacity: 0.3 !important;
            }
        </style>
    </head>
    <body>
        <div class="container pb-5">
            <div class="row mt-2 mb-3">
                <div class="col-md-5 text-center" >
                    <img class="img-thumbnail sticky-top" src="affiche.php?csv=<?php echo $GET['csv'] ?>" />
                    <div class="spinner-border mt-5" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">Texte</div>
                        <div class="card-body">
                            <div class="row mb-2">
                                <label for="inputPassword6" class="col-md-3 col-form-label">Titre de la 1ème ligne</label>
                                <div class="col-auto"><input autofocus="autofocus" id="input_titre_1" type="text" placeholder="2022 avec" value="<?php echo $title1 ?>" class="form-control"/></div>
                            </div>
                            <div class="row mb-2">
                                <label for="input_titre_2" class="col-md-3 col-form-label">Titre de la 2ème ligne</label>
                                <div class="col-auto"><input autofocus="autofocus" id="input_titre_2" type="text" placeholder="Foo Bar" value="<?php echo $title2 ?>" class="form-control"/></div>
                            </div><div class="row mb-2">
                                <label for="input_slogan" class="col-md-3 col-form-label">Slogan</label>
                                <div class="col-sm-8"><input id="input_slogan" type="text" value="<?php echo $slogan ?>" placeholder="Parce que je le mérite vraiment" class="form-control"/></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Fond</div>
                        <div class="card-body p-1">
                            <?php foreach($fonds as $key => $f): ?><input type="radio" name="fond" class="btn-check" id="btn_fond_<?php echo $key ?>" <?php if($f == $fond): ?>checked="checked"<?php endif; ?> autocomplete="off" value="<?php echo $f ?>"><label class="btn btn-link btn-sm p-0 m-0 btn-radio-image" for="btn_fond_<?php echo $key ?>"><img style="height: 65px;" src="fond/miniature/<?php echo str_replace(".png", ".jpg", $f) ?>" /></label><?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Tenue</div>
                        <div class="card-body p-1 ">
                            <?php foreach($tenues as $key => $t): ?><input type="radio" name="tenue" class="btn-check" id="btn_tenue_<?php echo $key ?>" <?php if($t == $tenue): ?>checked="checked"<?php endif; ?> autocomplete="off" value="<?php echo $t ?>"><label class="btn btn-link btn-sm p-0 m-0 btn-radio-image" for="btn_tenue_<?php echo $key ?>"><img style="height: 55px;" src="tenue/miniature/<?php echo $t ?>" /></label><?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Pied de page</div>
                        <div class="card-body p-1 ">
                            <?php foreach($footers as $key => $f): ?><input type="radio" name="footer" class="btn-check" id="btn_footer_<?php echo $key ?>" <?php if($f == $footer): ?>checked="checked"<?php endif; ?> autocomplete="off" value="<?php echo $f ?>"><label class="btn btn-link btn-sm p-0 m-0 btn-radio-image" for="btn_footer_<?php echo $key ?>"><img style="height: 50px;" src="footer/miniature/<?php echo $f ?>" /></label><?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-header">Disposition</div>
                        <div class="card-body p-1 ">
                            <?php foreach($templates as $key => $t): ?><input type="radio" name="template" class="btn-check" id="btn_template_<?php echo $key ?>" <?php if($t == $template): ?>checked="checked"<?php endif; ?> autocomplete="off" value="<?php echo $t ?>"><label class="btn btn-link btn-sm p-0 m-0 btn-radio-image" for="btn_template_<?php echo $key ?>"><img style="height: 100px;" src="template/miniature/<?php echo str_replace(".svg", ".png", $t) ?>" /></label><?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-bottom bg-light p-2">
            <div class="container">
                <form action="index.php" method="GET">
                <div class="input-group">
                    <button class="btn btn-primary" type="submit">Valider et voir l'affiche</button>
                    <input id="input_csv" type="text" class="form-control opacity-50" name="csv" />
                </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function updateCSV() {
                document.querySelector('#input_csv').value = document.querySelector('#input_titre_1').value+";"+document.querySelector('#input_titre_2').value+";"+document.querySelector('#input_slogan').value+';'+document.querySelector('input[name=template]:checked').value+';'+document.querySelector('input[name=fond]:checked').value+';'+document.querySelector('input[name=tenue]:checked').value+';'+document.querySelector('input[name=footer]:checked').value
            }
            document.querySelectorAll('#input_titre_1, #input_titre_2, #input_slogan').forEach(function(input) {
                input.addEventListener('keyup', function(event) {
                    updateCSV();
                });
            });
            document.querySelectorAll('input[type=radio]').forEach(function(input) {
                input.addEventListener('change', function(event) {
                    updateCSV();
                });
            });
            updateCSV();
        </script>
    </body>
</html>
