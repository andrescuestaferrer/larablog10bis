<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<h1> Larablog10 </h1>
</p>

## About Larablog10

Larablog10 is a web made with the framework *Laravel*, to publish posts in html format, ordered by cathegories/subcathegories and user, stored into a *MariaDB* database.

There are two types of users. The administrators users have the ability to change cathegories/subcathegories, users and posts. The users whith no administration rights only can manage their own posts.

## Changelog
> First Commit : Installed Laravel 10.0 and setup database on .env

> Second Commit : Organize routes and folders

- public\back  
- public\front
- resources\views\back
- resources\views\back\layouts    `auth-layout.blade.php`   `pages-layout.blade.php`
- resources\views\back\pages      `home.blade.php`
- resources\views\back\pages\auth    `forgot.blade.php`   `login.blade.php`
- resources\views\front
- app\Http\Controllers    `AuthorController.php`
- routes    `web.php`