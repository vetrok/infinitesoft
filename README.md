InfiniteSoft test task
============================

Deployment manual
------------

1. Clone repository to your machine
------------

2. Update composer
------------

~~~
"php composer update"
~~~

Troubleshooting:
Composer will require some additional configuration if you don't have it - check manual for Yii2 installation

3. Insert database credentials in config\db.php
------------

4. Database set-up
------------
a)  Apply dump file, will be attached to project archive

b)  You can create database manually and migrate tables with yii migration tool

~~~
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
php yii migrate
~~~

5. Configure mail server config\web.php, check yii2 manual
------------
Currently e-mail's are storing at local file, there can be found activation link for new users, but it has inappropriate format,
so better configure mail server

6. Configure your web server and point to basic\web
------------

7. Visit main page
------------

Disclaimer

I used several composer packages, specially for User management, database has extra fields which package required
Application configured in development mode, that's why some test config files are left and Yii2 commercial are left
