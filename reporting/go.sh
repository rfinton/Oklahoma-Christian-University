#!/bin/bash

DIR="OCU"

cd /home/guest/$DIR/clickCAPTURE/
php clickCAPTURE.php
mv *.zip archive

cd ../Inquiries
php buildReport.php
mv *.zip archive

cd ../IQP
php buildReport.php
mv *.zip archive

cd ../Score
php score.php
mv *.zip archive

cd ..
php sendreport.php