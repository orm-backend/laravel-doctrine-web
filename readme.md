# Controllers, resources and routing for building application from scratch.

## Dependencies

 * [laravel/ui](https://github.com/laravel/ui)
 * [orm-backend/laravel-doctrine](https://github.com/orm-backend/laravel-doctrine)
 * [orm-backend/laravel-doctrine-acl](https://github.com/orm-backend/laravel-doctrine-acl)

## Install

* Add composer repositories

```BASH
"repositories": [
	{
       "type": "vcs",
       "url": "git@github.com:orm-backend/laravel-doctrine.git"
    },
    {
       "type": "vcs",
       "url": "git@github.com:orm-backend/laravel-doctrine-acl.git"
    },
    {
       "type": "vcs",
       "url": "git@github.com:orm-backend/laravel-doctrine-web.git"
    }
]
```

* Install packages

```BASH
composer require orm-backend/laravel-doctrine-web
```

```BASH
npm install jquery popper.js bootstrap
npm install css-loader@3 --save-dev
```

* Publising _This command will owerride resources/js/app.js and resources/sass/app.scss_

```BASH
php artisan vendor:publish --provider="OrmBackend\Web\PackageServiceProvider" --force
```

* Compiling

```BASH
npm run dev
```

## Setting up

* Adding menu listener in app/Providers/EventServiceProvider

```PHP
protected $listen = [
        ***
        
    BeforMenu::class => [
        BeforMenuListener::class,
    ],
];
```

## Next

To have a powerful Admin Panel, install the [orm-backend/laravel-doctrine-admin](https://github.com/orm-backend/laravel-doctrine-admin) package.

