# Easily convert images with Glide Image Utility.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mindinventory/glide-image-utility.svg?style=flat-square)](https://packagist.org/packages/mindinventory/glide-image-utility)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/mindinventory/glide-image-utility/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mindinventory/glide-image-utility/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/mindinventory/glide-image-utility/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mindinventory/glide-image-utility/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mindinventory/glide-image-utility.svg?style=flat-square)](https://packagist.org/packages/mindinventory/glide-image-utility)

This package provides an easy-to-use class to manipulate images. Using this package we can manipulate aws s3 bucket image also.

## Installation

You can install the package via composer:

```bash
composer require mindinventory/glide-image-utility
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="glide-image-utility-config"
```

This is the contents of the published config file:

```php
return [

];
```

## Usage

```php
MiImage::createImage($ImagePath,['w'=> 50, 'h'=>100, 'fit'=>'crop', 'bg' => 'CCC']);
```

### In modification parameter you can use

**w** = Width,

**h** = Height,

**fit** = Fit parameter [contain, max, fill, stretch, crop],

**q** = Quality [Between 0 to 100],

**fm** = Format [jpg, pjeg(progressive jpg), gif, webp]

**bg** = Background Color [For More Colors](https://glide.thephpleague.com/1.0/api/colors/)

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [MindInventory](https://github.com/Mindinventory)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Let us know!
If you use our open-source libraries in your project, please make sure to credit us and Give a star to [www.mindinventory.com](https://mindinventory.com/)


![alt text](https://git.mindinventory.com/uploads/-/system/appearance/header_logo/1/mi-logo.png)

<a href="https://www.mindinventory.com/contact-us.php?utm_source=gthb&utm_medium=repo&utm_campaign=npm-mi-image-resize" target="__blank">
<img src="https://github.com/Sammindinventory/MindInventory/raw/main/hirebutton.png" width="203" height="43"  alt="app development">
</a>
