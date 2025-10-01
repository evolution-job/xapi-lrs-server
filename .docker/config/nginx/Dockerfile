FROM node:lts-alpine

LABEL maintainer="Mathieu BOLDO <mathieu.boldo@entrili.com>"

# ADD Cloud certificate (Internet Proxy)
ADD conf/cloud-certificate.crt /etc/ssl/certs/cloud-certificate.crt
RUN cat /etc/ssl/certs/cloud-certificate.crt >> /etc/ssl/certs/ca-certificates.crt

RUN apk add --update --no-cache \
    nginx

RUN adduser -D -g 'www' www \
    && chown -R www:www /var/www

# Diet for container
RUN rm -rf /var/cache/apk/* \
    && rm -rf /tmp/*

RUN mkdir -p /run/nginx

# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/dev.access.log \
	&& ln -sf /dev/stderr /var/log/nginx/dev.error.log

CMD ["nginx"]