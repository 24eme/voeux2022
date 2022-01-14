<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h2>Choisissez le texte de votre affiche</h2>
                    <form action="affiche.php" method="GET">
                        <div class="mb-3">
                            <label for="input_titre_1" class="form-label">Titre de la 1ère ligne</label>
                            <input autofocus="autofocus" id="input_titre_1" type="text" placeholder="2022 avec" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="input_titre_2" class="form-label">Titre de la 2ème ligne</label><input id="input_titre_2" type="text" placeholder="Foo Bar" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="input_slogan" class="form-label">Slogan</label><input id="input_slogan" type="text" value="" placeholder="Parce que je le mérite vraiment" class="form-control"/>
                        </div>
                        <div class="input-group mb-3">
                            <input id="input_csv" name="csv" type="text" class="form-control opacity-25" placeholder=";;;">
                            <button class="btn btn-primary" type="submit">Continuer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function updateCSV() {
                document.querySelector('#input_csv').value = document.querySelector('#input_titre_1').value+";"+document.querySelector('#input_titre_2').value+";"+document.querySelector('#input_slogan').value;
            }
            document.querySelectorAll('#input_titre_1, #input_titre_2, #input_slogan').forEach(function(input) {
                input.addEventListener('keyup', function(event) {
                    updateCSV();
                });
            });
            updateCSV();
        </script>
    </body>
</html>
