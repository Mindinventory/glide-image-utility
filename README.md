# Glide Image Utility
Easily convert images with Glide Image Utility

This package provides an easy to use class to manipulate images. Using this package we can manipulate aws s3 bucket image too.

Here's an example of how the package can be used:

```php
MiImage::createImage($ImagePath,['w'=> 50, 'h'=>100, 'fit'=>'crop']);
```

## Installation

You can install the package through Composer.

```bash
composer require mindinventory/glide-image-utility
```

In Laravel 5.5 the service provider and facade will automatically get registered. In older versions of the framework just add the service provider and facade in `config/app.php` file:

```php
'providers' => [
    ...
    Mi\MiImageUtility\ImageServiceProvider::class,
    ...
];
```

You can publish the config file of the package using artisan.

```bash
php artisan vendor:publish --provider="Mi\MiImageUtility\ImageServiceProvider" --tag=config
```

The config file looks like this:
```php

<?php

return [

    /* This is cache folder that create inside storage/images/cache folder */
    'cache_folder' => env('Cache_Folder', storage_path('images/cache')),
];

```
## Usage 

Here's a quick example that shows how an image can be modified:

```php
MiImage::createImage($pathToImage,['w'=> 50, 'h'=>50, 'fit'=>'crop']);
```

In modification parameter you can use 
    w = Width,
    h = Height,
    fit = Fit parameter [contain, max, fill, stretch, crop],
    q = Quality [Between 0 to 100],
    fm = Format [jpg, pjeg(progressive jpg), gif, webp]
    

## Support us

Mindinventory itself is a self-explanatory word. In fact, we have accumulated the best talents available in India, particularly from the eminent technical education institutes located at Ahmedabad in the western Indian region where headquarter is located. Please visit [our website](https://mindinventory.com).
