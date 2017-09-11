#!/bin/bash

cd $(dirname $0)

FRONT_END_HASH=$(git rev-parse --short HEAD)

rm -r out/*
mkdir out/js
mkdir out/css

echo 'Generating lang.js...'
php ./dump_js_lang.php

echo 'Packing JS...'
npm run babel -- -o "out/js/app.$FRONT_END_HASH.js" --source-maps js/lib \
    js/lib/chibi.js \
    js/lib/keymaster.js \
    js/lib/polyfills.js \
    js/utils.js \
    js/modal.js \
    js/notif.js \
    js/appcommon.js \
    js/lang.js \
    js/wifi.js \
    js/term_* \
    js/debug_screen.js \
    js/soft_keyboard.js \
    js/term.js

echo 'Building CSS...'

npm run sass -- --output-style compressed sass/app.scss "out/css/app.$FRONT_END_HASH.css"

echo 'Building HTML...'

php ./compile_html.php

echo 'Copying resources...'

cp -r img out/img
cp favicon.ico out/

if [[ $ESP_PROD ]]; then
	echo 'Cleaning junk files...'
	find out/ -name "*.orig" -delete
	find out/ -name "*.xcf"  -delete
	find out/ -name "*~"     -delete
	find out/ -name "*.bak"  -delete
	find out/ -name "*.map"  -delete
fi

echo 'ESPTerm front-end ready'
