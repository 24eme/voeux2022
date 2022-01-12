#!/bin/bash

output=$1 #in output/
template=$2 #in template/
aaa=$3
bbb=$4
ccc=$5
fond=$6
footer=$7
tenue=$8
qrcode=$9

echo "s|fond/template_fond.png|"$fond"|" > $output".sed"
echo "s|tenue/template_tenue.png|"$tenue"|" >> $output".sed"
echo "s|footer/template_footer.png|"$footer"|" >> $output".sed"
echo "s|AAATEMPLATEAAA|"$aaa"|" >> $output".sed"
echo "s|BBBTEMPLATEBBB|"$bbb"|" >> $output".sed"
echo "s|CCCTEMPLATECCC|"$ccc"|" >> $output".sed"
if test "$qrcode"; then
echo "s|qrcode/template_qrcode.png|"$qrcode"|" >> $output".sed"
else
echo "s|inkscape:label=\"intérieur tête\" * style=\"display:inline\"|inkscape:label=\"intérieur tête\" style=\"display:none\"|" >> $output".sed"
fi
cat $template | tr '\n' ' ' | sed -f $output".sed" > $output".svg"

inkscape $output".svg" --export-area-page --batch-process --export-type=pdf --export-filename=$output
inkscape $output".svg" --export-area-page --batch-process --export-type=png --export-filename=$output".png"

rm $output".sed" $output".svg"
