Laravel Themes
=====
## Overview

This package provides themes support for Laravel framework.

Themes are understood here as folders that contains views overriding your default ones.  
So, you don't need to specify themes anywhere in your code excepting themes module configuration.

Solution is extremely simple and utilizes features of Laravel architecture right way. 
Just read the code, it's a few files containing few lines. 

### Features

* Fallback themes (If view was not found in theme folder it will be searched in fallback themes and then in your default app views)


## Installation

Best way to install this package is using composer.

* Step 1: Add git url to composer.json file in your project:
```
"repositories": [
    {
        "url": "https://github.com/Nayjest/laravel-themes.git",
        "type": "git"
    }
],
```
* Step 2: Add dependency to "require" section
```
"require": {
    "nayjest/themes": "~1.0"
},
```
* Step 3: run "composer update" command

## Usage

1. Publish package configuration:

```
php artisan config:publish nayjest/themes
```

2. Read the config and change something there if you need.

By default, 'default' theme will be used with 'theme_prefix' option == 'theme_' and 'base_path' == default app views folder.

So, theme folder will be: app/views/theme_default

3. Copy views that you want to customize to theme folder and modify there.

Example: 

default (old) view file location:

    app/views/packages/my/users/list.blade.php

themed view location:

    app/views/theme_default/packages/my/users/list.blade.php

## License


© 2014 Vitalii Stepanenko

Licensed under the MIT License
