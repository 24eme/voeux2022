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
        <style>
            .btn-check:checked + label.btn-radio-image, .btn-check:checked + label.btn-radio-image:active {
                opacity: 0.3 !important;
            }
        </style>
    </head>
    <body>
        <div class="container pb-5">
            <div class="row mt-2 mb-3">
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
                    <div class="card mt-2 mb-1">
                        <div class="card-header">Disposition</div>
                        <div class="card-body p-1 ">
                            <?php foreach($templates as $key => $t): ?><input type="radio" name="template" class="btn-check" id="btn_template_<?php echo $key ?>" <?php if($t == $template): ?>checked="checked"<?php endif; ?> autocomplete="off" value="<?php echo $t ?>"><label class="btn btn-link btn-sm p-0 m-0 btn-radio-image" for="btn_template_<?php echo $key ?>"><img style="height: 100px;" src="template/miniature/<?php echo str_replace(".svg", ".png", $t) ?>" /></label><?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 text-center pt-1 position-relative">
                    <div class="sticky-md-top">
                    <a name="affiche"></a>
                    <div id="image_loader" class="spinner-border text-dark position-absolute start-50 opacity-50" style="position: absolute; z-index: 999; top: 30px;" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div>
                    <img id="image_affiche" class="img-thumbnail" src="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="fixed-bottom bg-light p-2">
            <div class="container">
                <form action="camera.php" method="GET">
                    <div class="d-none d-md-block">
                        <div class="row">
                            <div class="col-9">
                                <div class="input-group">
                                    <button id="btn_csv_copy" class="btn btn-outline-secondary" type="button"><i class="bi bi-clipboard"></i></button>
                                    <input id="input_csv" type="text" class="form-control opacity-50" readonly="readonly" name="csv" value="<?php echo $csv ?>" />
                                    <button id="btn_csv_edit" class="btn btn-outline-secondary" type="button"><i class="bi bi-pencil"></i></button>
                                </div>
                            </div>
                            <div class="d-grid gap-2 col-3">
                                <button class="btn btn-primary" type="submit">Continuer</button>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-none row">
                        <div class="d-grid gap-2 col-6">
                            <a href="#affiche" class="btn btn-outline-secondary"><small id="btn_image_loader" class="spinner-border spinner-border-sm invisible float-end opacity-25" role="status" aria-hidden="true"></small>Voir l'affiche</a>
                        </div>
                        <div class="d-grid gap-2 col-6">
                            <button class="btn btn-primary" type="submit">Continuer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function updateCSV() {
                document.querySelector('#input_csv').value = document.querySelector('#input_titre_1').value+";"+document.querySelector('#input_titre_2').value+";"+document.querySelector('#input_slogan').value+';'+document.querySelector('input[name=template]:checked').value+';'+document.querySelector('input[name=fond]:checked').value+';'+document.querySelector('input[name=tenue]:checked').value+';'+document.querySelector('input[name=footer]:checked').value
            }
            function updateAffiche() {
                document.querySelector('#image_affiche').src = "affiche.php?csv="+encodeURI(document.querySelector('#input_csv').value);
                document.querySelector('#image_loader').classList.remove('d-none');
                document.querySelector('#btn_image_loader').classList.remove('invisible');
                document.querySelector('#image_affiche').classList.add('opacity-50');
            }
            
            document.querySelectorAll('#input_titre_1, #input_titre_2, #input_slogan').forEach(function(input) {
                input.addEventListener('keyup', function(event) {
                    updateCSV();
                });
            });
            document.querySelectorAll('input').forEach(function(input) {
                input.addEventListener('change', function(event) {
                    updateCSV();
                    updateAffiche();
                });
            });
            document.querySelector('#btn_csv_copy').addEventListener('click', function() {
                document.querySelector('#input_csv').focus()
                navigator.clipboard.writeText(document.querySelector('#input_csv').value);
                document.querySelector('#btn_csv_copy').focus();
            })
            document.querySelector('#btn_csv_edit').addEventListener('click', function() {
                let csv = prompt("CSV", document.querySelector('#input_csv').value);
                if(!csv) {
                    return;
                }
                document.querySelector('#input_csv').value = csv;
                updateAffiche();
            })
            document.querySelector('#image_affiche').addEventListener('load', function() {
                document.querySelector('#image_loader').classList.add('d-none');
                document.querySelector('#btn_image_loader').classList.add('invisible');
                document.querySelector('#image_affiche').classList.remove('opacity-50');
            });
            
            updateCSV();
            updateAffiche();
        </script>
    </body>
</html>
