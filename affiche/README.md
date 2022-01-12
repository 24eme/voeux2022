# Generation affiche

    bash bin/generate.sh output/output.pdf template/dessin_droite.svg "2022 avec" "Foo Bar" "Parce que je le mérite vraiment" fond/template_fond.png footer/oblique_24eme.png tenue/template_tenue.png qrcode/template_qrcode.png

genère :

![Affiche Foo Bar](exemples/foobar.pdf.png "2022 avec Foo Bar")

## Détourage de la photo

Installation de l'outil de détourage :

```
sudo pip install backgroundremover
```

Détourage de l'image : 

```
backgroundremover -a -ae 5 -i image.png -o image_decoupe.png
```
