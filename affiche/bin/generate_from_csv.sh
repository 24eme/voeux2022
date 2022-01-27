#!/bin/bash

cat $1 | grep ';' | awk '{gsub("'"'"'", "'"'"'\"'"'"'\"'"'"'", $0); print "wget --content-disposition '"'"'https://voeux.24eme.fr/2022/affiche.php?format=pdf&csv="$0"'"'"';"}' | bash
ls 2*.pdf | sed s'/.._.*//'| uniq | while read id ; do pdftk "$id"* cat output "merged_"$id".pdf";  done
