#!/bin/bash

rm -- *.mosaic.png

find . -type f -print0 | while mapfile -n 10 -d '' files && [ ${#files[@]} -gt 0 ]; do
    montage -mode concatenate -geometry 75%x -tile 5x2 "${files[@]}" "${files[0]}.mosaic.png";
done

montage -mode concatenate -geometry 100%x -- *.mosaic.png full.png
