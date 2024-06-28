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

> 7 : Blog Administration  - Author/Profile Page - (Livewire-UpgradeGuide-2.x-3.x Events)

- routes              `author.php`
- resources\views\back\layouts\inc    `header.blade.php`
- resources\views\back\pages    `profile.blade.php`
- app\Livewire   `TopHeader.php`  `AuthorProfileHeader.php`   `AuthorPersonalDetails.php`
- resources\views\livewire    `top-header.blade.php`    `author-profile-header.blade.php`  `author-personal-details.blade.php`

> 8 : Integrate jQuery Toast Messages with traits implemented in Commonfunctions.php

- public\back\dist\libs\jquery    `jquery-3.6.0.min.js`
- public\back\dist\libs\ijabo     `ijabo.min.js`    `ijabo.min.css`
- resources\views\back\layouts    `pages-layout.blade.php`
- app\Livewire   `AuthorPersonalDetails.php`
- public\traits  `CommonFunctions.php` 

> 9 :  Blog Administration  - Change Password Form (Validate regex and strong pwd custom rule)

- resources\views\back\pages    `profile.blade.php`
- app\Livewire   `AuthorChangePasswordForm.php`  
- resources\views\livewire    `author-change-password-form.blade.php` 

> 10 :  Blog Administration  - Change Profile Picture

- public\back\dist\image\authors    `default-img.png` `AIMG1171896834756899.jpg`
- app\Models   `User.php`  
- resources\views\livewire    `author-profile-header.blade.php`   `top-header.blade.php`
- public\back\dist\image\libs\ijaboCropTools    `ijaboCropTool.min.css`    `ijaboCropTool.min.js`
- resources\views\back\layouts    `pages-layout.blade.php`
- routes    `author.php`
- resources\views\back\pages    `profile.blade.php`
- app\Http\Controllers    `AuthorController.php`

> 11 : Extract log of changes from README.md to CHANGELOG.md
-  `README.md` `CHANGELOG.md`

> 12 : Blog Administration  - Blog Settings Page 
- routes    `author.php`
- resources\views\livewire    `top-header.blade.php`     `author-general-settings.blade.php`    `author-footer.blade.php` 
- resources\views\back\pages    `settings.blade.php`
- app\Models                   `Setting.php`
- database\migrations          `yyyy_mm_dd_hhmmss_create_settings_table.php`
- app\Livewire   `AuthorGeneralSettings.php`    `AuthorFooter.php`
- resources\views\back\layouts\inc    `footer.blade.php`

> 13 : Blog Administration  - Blog Logo 
- public\back\dist\libs\ijaboViewer    `jquery.ijaboViewer.min.js`
- public\back\dist\image\logo-favicon   `xxxxxxxxxx_xxxxx_larablog_logo.png`
- resources\views\back\layouts    `pages-layout.blade.php`
- resources\views\back\pages    `settings.blade.php`
- app\model    `Setting.php` 
- routes    `author.php`
- app\Http\Controllers    `AuthorController.php`
- resources\views\livewire    `top-header.blade.php`
- resources\views\back\pages\auth    `login.blade.php`    `reset.blade.php`    `forgot.blade.php`