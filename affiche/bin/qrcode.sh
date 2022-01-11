#!/bin/bash

url=$1 #max 42 car like : https://2021.24eme.fr/01234567890123456789
output=$2

echo "$url" | qrencode -i -m 1 -l H -o $2
