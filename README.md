Application de covoiturage
======================
Cir 3 API + Webclient Project, starring Symfony and Angular 5

Instructions de déploiement:
----------------------------
Vous devez avoir un environnement Apache PHP mysql configuré, Ainsi que git et composer pour pouvoir réaliser l'installation

Cloner le dépôt :
```
git clone https://github.com/nd4pa/framework-project.git
```

Déplacer le projet dans /var/www
```
mv framework-project /var/www
```
Mettre les droits nécessaires pour l'installation
```
chmod 777 -R /var/www/framework-project
```

Installer la Base de données
```
mysql -u your_user -D your_db_name -p < /var/www/framework-project/db/covoiturage.sql
```

Mettre en place les virtualhosts Apache
```
cp /var/www/framework-project/apache-conf/symfony.conf /etc/apache2/sites-available/
cp /var/www/framework-project/apache-conf/angular.conf /etc/apache2/sites-available/
a2ensite angular
a2ensite symfony
service apache2 restart
```

Installer les dépendances symfony
```
cd /var/www/framework-project/covoiturage
composer install --no-dev --optimize-autoloader
```
Entrez vos information de base de donnée:
url: 127.0.0.1
port: 3306
username: your_username
password: your_password

les autres informations ne sont pas utilisées et peuvent être laissées à leur valeur d'origine

Vider le cache
```
bin/console cache:clear --env=prod  --no-debug
```

Attribuer les droit du serveur web au dépot
```
chown -R www-data /var/www/framework-project
```

Connectez vous à http://prjsymf.cir3-frm-smf-ang-xx/ et http://foang.cir3-frm-smf-ang-xx/ pour tester.

