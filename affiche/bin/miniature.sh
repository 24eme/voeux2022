rm -f fond/miniature/*
mogrify -resize 300x -shave 0x70 -gravity Center -path fond/miniature/ -format jpg fond/*.png
rm -f tenue/miniature/*
mogrify -resize x300 -shave 50x0 -gravity center -path tenue/miniature/ -format png tenue/*.png
cd template
rm -f miniature/*
mogrify -resize 300x -path miniature/ -format png *.svg
cd -
rm -f footer/miniature/*
mogrify -resize x300 -crop 50x -gravity South -path footer/miniature/ -format png footer/*.png
