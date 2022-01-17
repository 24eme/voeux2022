#!/bin/bash

realoutput=$1 #peut être relatif ou absolu
template=$2 #in template/ (relatif à la racine du projet)
aaa=$3
bbb=$4
ccc=$5
fond=$6 #(relatif à la racine du projet)
footer=$7 #(relatif à la racine du projet)
tenue=$8 #(relatif à la racine du projet)
qrcodecontent_ou_tete=$9 #text ou chemin de la photo

output="output/"$$""

cd $(dirname $0)/..

if test -f "$qrcodecontent_ou_tete"; then
    tete=$qrcodecontent_ou_tete
    tetepng=$output"_tete.png"
    tetepngresized=$output"_teteresized.png"
    mkdir -p /tmp/backgroundremover4affiche"."$USER
    HOME=/tmp/backgroundremover4affiche"."$USER backgroundremover -a -ae 5 -i $tete -o $tetepng
    convert $tetepng -background 'rgba(0,0,0,0)' -gravity south -extent 1800x1800 -channel a tete/template_tete_transparency.png  -compose multiply -composite $tetepngresized
else
    qrcodetxt=$qrcodecontent_ou_tete
    qrcode=$output".qrcode.png"
    echo "$qrcodetxt" | qrencode -m 1 -l H -o $qrcode
fi
echo "s|fond/template_fond.png|"$fond"|" > $output".sed"
echo "s|tenue/template_tenue.png|"$tenue"|" >> $output".sed"
echo "s|footer/template_footer.png|"$footer"|" >> $output".sed"
if test "$tetepng"; then
echo "s|tete/template_tete.png|"$tetepngresized"|" >> $output".sed"
else
echo "s|tete/template_tete.png|tete/tete_transparente.png|" >> $output".sed"
fi
echo "s|AAATEMPLATEAAA|"$aaa"|" >> $output".sed"
echo "s|BBBTEMPLATEBBB|"$bbb"|" >> $output".sed"
echo "s|CCCTEMPLATECCC|"$ccc"|" >> $output".sed"
if test "$qrcode"; then
echo "s|qrcode/template_qrcode.png|"$qrcode"|" >> $output".sed"
else
echo "s|inkscape:label=\"intérieur tête\" * style=\"display:inline\"|inkscape:label=\"intérieur tête\" style=\"display:none\"|" >> $output".sed"
fi
cat $template | tr '\n' ' ' | sed -f $output".sed" > $output".svg"

if echo $realoutput | grep pdf > /dev/null ; then
inkscape $output".svg" --export-area-page --batch-process --export-type=pdf --export-filename=$output".pdf"
mv $output".pdf" $realoutput
else
inkscape $output".svg" --export-area-page --batch-process --export-type=png --export-filename=$output".png"
mv $output".png" $realoutput
fi

rm $output".sed" $output".svg" $tetepngresized $tetepng $qrcode
