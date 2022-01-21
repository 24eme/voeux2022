#!/bin/bash

cat $1 | grep ';' | awk '{gsub("'"'"'", "'"'"'\"'"'"'\"'"'"'", $0); print "wget --content-disposition '"'"'https://voeux.24eme.fr/2022/affiche.php?format=pdf&csv="$0"'"'"';"}' | bash
