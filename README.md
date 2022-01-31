# Carte de voeux 2022

Ce projet a permis de fabriquer les affiches que nous avons envoyé comme carte de voeux. Il permet aussi pour ceux qui ont reçu une affiche de se prendre en photo pour la terminer.

<center>
<img src="https://www.24eme.fr/img/2022_affiche_brigitte.png" height="300"> <img src="https://www.24eme.fr/img/2022_affiche_patrick.png" height="300">
<small>Exemples d'affiches générées</small>
</center>

<center>
<img src="https://www.24eme.fr/img/2022_affiche_patrick_resultat.png" height="300"/>
<small>Exemple d'une affiche avec incrustation de photo</small>
</center>

## Deployer le projet

Dépendances :

```
aptitude install php inkscape qrencode convert imagemagick
```

Il faut aussi installer [l'outil de détourage de photo](#détourage-de-la-photo)

Lancer en local :

```
php -S localhost:8000 -t public
```

## Generation affiche
    cd affiche
    bash bin/generate.sh output/output.pdf template/dessin_droite.svg "2022 avec" "Foo Bar" "Parce que je le mérite vraiment" fond/template_fond.png footer/oblique_24eme.png tenue/template_tenue.png qrcode/template_qrcode.png

genère :

![Affiche Foo Bar](exemples/foobar.pdf.png "2022 avec Foo Bar")

## Détourage de la photo

Installation de l'outil de détourage :

Si pas de GPU (https://ourcodeworld.co/articulos/leer/1610/como-eliminar-el-fondo-de-una-imagen-con-machine-learning-usando-rembg-python-3-en-ubuntu-2004) :

```
sudo pip install torch==1.7.1+cpu torchvision==0.8.2+cpu -f https://download.pytorch.org/whl/torch_stable.html
```

```
sudo pip install backgroundremover
```

Détourage de l'image : 

```
backgroundremover -a -ae 5 -i image.png -o image_decoupe.png
```

## License libre

Le code source est sous licence libre AGPL, toutes les images et photos utilisés sont compatible avec la licence libre.
