FROM oraclelinux:8.7

ARG PROXY=http://proxy:8080
ENV use_proxy yes
ENV http_proxy ${PROXY}
ENV https_proxy ${PROXY}
ENV no_proxy 127.0.0.1,localhost
RUN printf "\nproxy=${PROXY}\n" >> /etc/yum.conf 

RUN yum -y update && \
 	yum -y upgrade && \
 	yum -y install git wget unzip curl shellcheck && \
	yum clean all

RUN mkdir -p /script
WORKDIR /script
