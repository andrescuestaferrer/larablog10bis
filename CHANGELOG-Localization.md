## Changelog
> L-1 : Localization test - php artisan lang:publish

- `CHANGELOG.md`  `CHANGELOG-Localization.md`
- lang\en    `auth.php`    `pagination.php`    `passwords.php`    [`validation.php`](./lang/en/validation.php "Validation Language Lines")
- lang    `es.json`
- routes    `author.php` 
- app\Livewire   `AuthorLoginForm.php`
- resources\views\livewire    `author-login-form.blade.php`

> L-2 : Replacing parameters in a locale language file json

- `CHANGELOG-Localization.md`
- lang    `es.json`
- app\Livewire   `AuthorLoginForm.php`

> L-3 : Importing locale language files for es language

- `CHANGELOG-Localization.md`
- lang\es   [`actions.php`](./lang/es/actions.php) [`auth.php`](./lang/es/auth.php)  [`pagination.php`](./lang/es/pagination.php)  [`passwords.php`](./lang/es/passwords.php)  [`validation.php`](./lang/es/validation.php)

> L-4 : Implementing switch of accepted languages

>> LANGUAGE DEFINITIONS

- lang    [`es.json`](./lang/es.json)    [`fr.json`](./lang/fr.json)

>> App CONFIGURATION

- config    [`app.php`](./config/app.php)

>> SWITCHER: VIEW

- routes    [`web.php`](./routes/web.php)
- resources\views\back\layouts\inc     [`lang-switcher.blade.php`](./resources/views/back/layouts/inc/lang-switcher.blade.php)

>> SWITCHER: CONTROLLER

- app/Http/Middleware    [`Localization.php`](./app/Http/Middleware/Localization.php)
- app/Http/Kernel        [`Kernel.php`](./app/Http/Kernel.php)

>>   VIEWS TO INCLUDE SWITCHER

- resources\views\back\layouts     [`auth-layout.blade.php`](./resources/views/back/layouts/auth-layout.blade.php)
- resources\views\livewire     [`top-header.blade.php`](./resources/views/livewire/top-header.blade.php) 

>>  VIEWS TO TRANSLATE TEXTS

- resources\views\back\pages\auth     [`login.blade.php`](./resources/views/back/pages/auth/login.blade.php)