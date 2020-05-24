# Controllers, resources and routing for building application from scratch.

## Requirements

* laravel-ui
* it-aces/laravel-doctrine
* it-aces/laravel-doctrine-acl

## Installation

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

* Publising

```BASH
php artisan vendor:publish --provider="ItAces\Web\PackageServiceProvider"
```

* Compiling

```BASH
npm run dev
```

