FROM aamservices/opencart:latest

RUN apt-get update && apt-get install -y \
mc

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data