#!/bin/bash
set -o xtrace
openssl genrsa -des3 -out myCA.key 2048
openssl req -x509 -new -nodes -key myCA.key -sha256 -days 1825 -out myCA.pem -subj "/C=SK/ST=Slovakia/L=Bratislava/O=organization/OU=organization unit/CN=myCA"
openssl x509 -outform der -in myCA.pem -out myCA.crt
openssl genrsa -out myPage.key 2048
openssl req -new -key myPage.key -out myPage.csr -subj "/C=SK/ST=Slovakia/L=Bratislava/O=Organization/OU=Organization Unit/CN=myPage"
openssl x509 -req -in myPage.csr -CA myCA.pem -CAkey myCA.key -CAcreateserial -out myPage.crt -days 1825 -sha256 -extfile myPage.ext
read -p "done"
