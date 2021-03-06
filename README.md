# DEPRECATION WARNING
Deprecated in favor of [Market](https://github.com/ecomclub/market)

# addons-php
E-Com Plus Addons marketplace implemented in PHP 7

# Technology stack
+ MySQL 5.5 [MariaDB](https://mariadb.com/) version
+ [PHP](http://php.net/) 7.0.26
+ [Twig](https://twig.symfony.com/) template engine

# Setting up
For security, we recommend to download and install the app as root,
and let the scripts owned by `root:root` as default.

```bash
sudo git clone https://github.com/ecomclub/addons-php.git
cd addons-php
```

Copy sample configuration file and edit to place the constants of your environment.

```bash
sudo cp config/config-default.php config/config.php
sudo nano config/config.php
```

Run setup file as root.

```bash
sudo php -f init.php
```
Install Composer
```bash
cd composer/
```
Download and install Composer by following the [official instructions](https://getcomposer.org/download/).

After installing the composer, install twig using the composer
```bash
sudo ./composer.phar install
```

# Web server
You need to use a web server such as NGINX or Apache HTTP,
web server root is on directory `app`, each _.php_ file at this directory is one website URL.
