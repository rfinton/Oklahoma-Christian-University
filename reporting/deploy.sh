#!/bin/bash

DIR="OCU"

scp -i ~/.aws/Ubuntu-1.pem go.sh recipients.php sendreport.php ubuntu@52.91.158.44:/home/guest/$DIR/
scp -i ~/.aws/Ubuntu-1.pem clickCAPTURE/* ubuntu@52.91.158.44:/home/guest/$DIR/clickCAPTURE/
scp -i ~/.aws/Ubuntu-1.pem Inquiries/* ubuntu@52.91.158.44:/home/guest/$DIR/Inquiries/
scp -i ~/.aws/Ubuntu-1.pem Score/* ubuntu@52.91.158.44:/home/guest/$DIR/Score/
scp -i ~/.aws/Ubuntu-1.pem IQP/* ubuntu@52.91.158.44:/home/guest/$DIR/IQP/

# find {clickCAPTURE,Inquiries,Score} -regex '.*html\|.*send.*' -exec rm {} \;