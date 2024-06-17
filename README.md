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

> 3rd Commit : Integrate TablerAdmin template

- resources\views\back\layouts\inc    `header.blade.php`   `footer.blade.php`

> 4 : Laravel Livewire - Login process

- resources\views\back\layouts    `auth-layout.blade.php`   `pages-layout.blade.php`
- resources\views\livewire    `author-login-form.blade.php`
- app\Models           `Type.php`    `User.php`
- database\migrations   `2024_06_17_093115_create_types_table.php`
- routes    `web.php`   `author.php`
- app\Providers      `RouteServicesProvider.php`
- app\Http\Middleware    `Authenticate.php`    `RedirectIfAuthenticated.php`
- app\Livewire   `AuthorLoginForm.php`
- resources\views\back\pages\auth    `login.blade.php`
- resources\views\back\layouts\inc    `header.blade.php`
- app\Http\Controllers      `AuthorController.php`

> 5 : Login process - Login with username(case sensitive) or email

- app\Livewire   `AuthorLoginForm.php`

> 6 : Login process - Forgot and Reset password (Validate regex and strong pwd custom rule)

- app\Livewire   `AuthorForgotForm.php`    `AuthorResetForm.php`
- resources\views\livewire    `author-forgot-form.blade.php`  `author-reset-form.blade.php`  `author-login-form.blade.php`
- resources\views     `forgot-email-template.blade.php`
- resources\views\back\pages     `forgot.blade.php`
- routes              `author.php`
- app\Http\Controllers  `AuthorController.php
- resources\views\back\pages\auth    `reset.blade.php`