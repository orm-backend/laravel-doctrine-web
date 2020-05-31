# Controllers, resources and routing for building application from scratch.

## Dependencies

 * [laravel/ui](https://github.com/laravel/ui)
 * [it-aces/laravel-doctrine](https://bitbucket.org/vitaliy_kovalenko/laravel-doctrine/src/master/)
 * [it-aces/laravel-doctrine-acl](https://bitbucket.org/vitaliy_kovalenko/laravel-doctrine-acl/src/master/)

## Install

* Add composer repositories

```BASH
"repositories": [
	{
       "type": "vcs",
       "url": "git@bitbucket.org:vitaliy_kovalenko/laravel-doctrine.git"
    },
    {
       "type": "vcs",
       "url": "git@bitbucket.org:vitaliy_kovalenko/laravel-doctrine-acl.git"
    },
    {
       "type": "vcs",
       "url": "git@bitbucket.org:vitaliy_kovalenko/laravel-doctrine-web.git"
    }
]
```

* Install packages

```BASH
composer require it-aces/laravel-doctrine-web
```

```BASH
npm install cross-env css-loader jquery popper.js bootstrap
```

* Publising _This command will owerride resources/js/app.js and resources/sass/app.scss_

```BASH
php artisan vendor:publish --provider="ItAces\Web\PackageServiceProvider" --force
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

To have a powerful Admin Panel, install the [it-aces/laravel-doctrine-admin](https://bitbucket.org/vitaliy_kovalenko/laravel-doctrine-admin/src/master/) package.

