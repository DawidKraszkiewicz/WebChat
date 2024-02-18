FROM nginx:1.10

ADD docker/web/vhost.conf /etc/nginx/conf.d/default.conf
