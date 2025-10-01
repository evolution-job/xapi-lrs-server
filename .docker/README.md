 # Entrili-LRS Docker Stack

1. [NGINX & SSL certificates](#1-nginx--ssl-certificates)
2. [Run Docker Compose](#2-run-docker-compose)
3. [Available urls](#3-available-urls)

## 1. NGINX & SSL certificates

ADD following **lines** to your `C:\Windows\System32\drivers\etc\hosts` file in Administrator mode. (Mac: `/private/etc/hosts`).

    #Added by EntriliLRS App
    127.0.0.1 lrs.entrili.local
    ::1 lrs.entrili.local

Download **MKCERT** Windows/Mac binaries here : https://github.com/FiloSottile/mkcert/releases and put it in an accessible folder for your favorite terminal.

From the folder where you put mkcert binary, launch **PowerShell / favorite mac terminal** and run

    .\mkcert.exe -install
    .\mkcert.exe -cert-file entrili-lrs.local.crt -key-file entrili-lrs.local.key entrili.local *.entrili.local localhost 127.0.0.1 ::1

It automatically adds a rootCA in your local trusted certificates store and generates two files in the same folder.

- entrili-lrs.local.crt
- entrili-lrs.local.key

These two files have to be shared with the **NGINX** container to make SSL work. 

**Copy** these two files into your **.docker/config/nginx/certs** folder. They are ignored automatically from GIT.

To allow `curl` and other libraries in the php container to communicate with nginx over TLS 

**Copy** the rootCA.pem file to **.docker/config/php/rootCA.crt** (location of the original file can be found by launching .\mkcert.exe -CAROOT)

## 2. Run Docker Compose

To start Entrili LRS stack, Run `docker-compose up -d`.

## 3. Available urls

- App : <https://lrs.entrili.local:444/>