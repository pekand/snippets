FROM centos:latest

ENV DEBIAN_FRONTEND noninteractive

RUN yum -y update && \
    yum -y upgrade && \
    yum -y install epel-release curl vim && \
    rpm --import https://repo.saltproject.io/py3/redhat/8/x86_64/latest/SALTSTACK-GPG-KEY.pub && \
    curl -fsSL https://repo.saltproject.io/py3/redhat/8/x86_64/latest.repo | tee /etc/yum.repos.d/salt.repo && \
    yum clean expire-cache && \
    yum -y install salt-minion --skip-broken

CMD ["salt-minion"]
