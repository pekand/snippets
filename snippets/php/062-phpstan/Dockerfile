FROM centos:7.9.2009

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN yum -y update && \
 	yum -y upgrade && \
 	yum -y install epel-release yum-utils java-1.8.0-openjdk wget git mysql && \
 	yum install -y https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm && \
 	yum install -y https://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
 	yum install -y --skip-broken --enablerepo=remi-php80 \
 	php \
 	php-cli \
 	php-pecl-mysql \
 	php-pdo \
 	php-opcache \
 	php-xml \
 	php-pecl-imagick-im6 \
 	php-pecl-mcrypt \
 	php-pecl-yaml \
 	php-fpm \
 	php-gd \
 	php-pecl-rar \
 	php-pecl-redis5 \
 	php-ldap \
 	php-runtime \
 	php-pecl-ssh2 \
 	php-process \
 	php-mbstring \
 	php-pecl-zip \
 	php-pgsql \
 	php-pdo-dblib \
 	php-sqlsrv \
 	php-pecl-rdkafka5 \
	remi-php80 php-devel \
	php-pecl-xdebug3 \
 	php-pear && \
 	pear install PHP_CodeSniffer 
RUN yum clean all
RUN	wget -O composer-setup.php https://getcomposer.org/installer && \
 	php composer-setup.php && \
 	php -r "unlink('composer-setup.php');" && \
 	mv composer.phar /usr/local/bin/composer && \
 	composer global require --no-cache --no-progress squizlabs/php_codesniffer:3.6.2 phpcompatibility/php-compatibility:9.3.5 && \
 	phpcs --config-set installed_paths "/root/.config/composer/vendor/phpcompatibility/php-compatibility/PHPCompatibility" && \
	composer global config --no-plugins allow-plugins.phpstan/extension-installer true && \
	composer global require --no-cache --no-progress phpstan/phpstan  phpstan/extension-installer  phpstan/phpstan-mockery
 


