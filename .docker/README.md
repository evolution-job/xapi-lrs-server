 # Entrili-LRS Docker Stack

1. [NGINX & SSL certificates](#1-nginx--ssl-certificates)
2. [Run Docker Compose](#2-run-docker-compose)
3. [import database](#3-import-database)
4. [Edit .env.local](#5-edit-envlocal)
5. [Deploy for the first time](#7-deploy-for-the-first-time)
6. [Available urls](#8-available-urls)

## 1. NGINX & SSL certificates

ADD following **lines** to your `C:\Windows\System32\drivers\etc\hosts` file in Administrator mode. (Mac:  `/private/etc/hosts`).

    #Added by EntriliLRS App
    127.0.0.1 lrs.entrili.local
    ::1 lrs.entrili.local

Download **MKCERT** Windows/Mac binaries here : https://github.com/FiloSottile/mkcert/releases and put it in accessible folder for your favorite terminal.

From the folder where you put mkcert binary, launch **PowerShell / favorite mac terminal** and run

    .\mkcert.exe -install
    .\mkcert.exe -cert-file entrili-lrs.local.crt -key-file entrili-lrs.local.key entrili.local *.entrili.local localhost 127.0.0.1 ::1

It adds automatically a rootCA in your local trusted certificates store and generates 2 files in the same folder.

- entrili-lrs.local.crt
- entrili-lrs.local.key

These 2 files have to be shared with **NGINX** container in order to make SSL works. 

**Copy** these 2 files into your **.docker/config/nginx/certs** folder. They are ignored automaticaly from GIT.

In order to allow `curl` and other libraries in the php container to communicate with nginx over TLS 

**Copy** the rootCA.pem file to **.docker/config/php/rootCA.crt** (location of the original file can be found by launching .\mkcert.exe -CAROOT)

## 2. Run Docker Compose

To start EntriliLRS's Docker, Run `docker-compose up -d`.

## 3. Create Database

## 4. Edit .env.local

Don't forget to edit you `./.env.local` and add every parameter needed to make Entrili correctly run with Docker. 

## 5. Run it for the first time

In order to initialize Entrili-LRS App for the first, run in your terminal with 

`docker exec php sh -c /var/config/dump.sh`

Go to <https://dev.entrili.local/> and enjoy!

## 6. Available urls

- App : <https://lrs.entrili.local:444/>