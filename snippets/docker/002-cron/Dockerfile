FROM ubuntu:latest

RUN apt update && \
    apt -y upgrade && \
    apt -y install software-properties-common && \
    apt -y install \
        cron \
        curl \
        git \
        vim

RUN mkdir -p /app /logs
WORKDIR /app

COPY cronjobs /etc/cron.d/cronjobs
RUN chmod 0644 /etc/cron.d/cronjobs
RUN crontab /etc/cron.d/cronjobs
RUN touch /logs/cron.log

CMD ["cron", "-f"]
