#!/bin/bash

template=$1 #in template/ 
aaa=$2
bbb=$3
ccc=$4
fond=$5
footer=$6
tenue=$7
qrcode=$8
output=$9 #in output/

echo "s|fond/template_fond.png|"$fond"|" > $output".sed"
echo "s|qrcode/template_qrcode.png|"$qrcode"|" >> $output".sed"
echo "s|tenue/template_tenue.png|"$tenue"|" >> $output".sed"
echo "s|footer/template_footer.png|"$footer"|" >> $output".sed"
echo "s|AAATEMPLATEAAA|"$aaa"|" >> $output".sed"
echo "s|BBBTEMPLATEBBB|"$bbb"|" >> $output".sed"
echo "s|CCCTEMPLATECCC|"$ccc"|" >> $output".sed"

cat $template | sed -f $output".sed" > $output".svg"

inkscape $output".svg" --export-area-page --batch-process --export-type=pdf --export-filename=$output
inkscape $output".svg" --export-area-page --batch-process --export-type=png --export-filename=$output".png"

rm $output".sed" $output".svg"
