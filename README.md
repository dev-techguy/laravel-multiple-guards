# <p align="center"><a href="https://shiftechafrica.com/" target="_blank"><img width="100" src="https://shiftechafrica.com/img/logo.png"></a></p>

<p align="center">
  <b>Be in the next level</b><br>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/issues">
  <img src="https://img.shields.io/github/issues/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/network/members">
  <img src="https://img.shields.io/github/forks/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://github.com/dev-techguy/laravel-multiple-guards/stargazers">
  <img src="https://img.shields.io/github/stars/dev-techguy/laravel-multiple-guards.svg">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/shift-code-generator">
  <img src="https://poser.pugx.org/shiftechafrica/shift-code-generator/v/stable">
  </a>
  <a href="https://packagist.org/packages/shiftechafrica/shift-code-generator">
  <img src="https://poser.pugx.org/shiftechafrica/shift-code-generator/downloads">
  </a>
  <br><br>
  <img src="https://i.pinimg.com/originals/ce/69/4f/ce694f560636dffcf42ecf40d4f2f962.gif">
</p>

## Introduction
This package generates code in relation to year, date and month. For instance, it uses A - Z letters for months. For example *1E1NKJDQVW* code *1* rep number of years, *E* rep month and *1* rep date while *NKJDQVW* is a random string.
This library mimics the *mpesa-transaction-id*.

## Installing

The recommended way to install shift-code-generator is through
[Composer](http://getcomposer.org).

```bash
# Install package via composer
composer require shiftechafrica/shift-code-generator
```

Next, run the Composer command to install the latest stable version of *shiftechafrica/shift-code-generator*:

```bash
# Update package via composer
 composer update shiftechafrica/shift-code-generator --lock
```

After installing, the package will be auto discovered, But if need you may run:

```php
# run for auto discovery <-- If the package is not detected automatically -->
composer dump-autoload
```

Then run this, to get the *config/shift-code-generator.php* for your own configurations:

```php
# run this to get the configuration file at config/shift-code-generator.php <-- read through it -->
php artisan vendor:publish --provider="ShiftechAfrica\CodeGenerator\ShiftCodeGeneratorServiceProvider"
```
A *config/shift-code-generator.php* file will be created, so if you want to use the database follow the next step on how to seed. The following add to your .env file.

```php
  YEAR_OF_START=2020 #pass the year that your application is launched
  USE_DATABASE=false #pass true if you want to use the database and false to use your default YEAR_OF_START
```


You will have to add this in the *database/seeds/DatabaseSeeder*. To ensure we seed some data to set the default dates that will be used in generating the codes:

```php
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         // other seeds...
         $this->call(\ShiftechAfrica\CodeGenerator\Seeds\ShiftCodeGeneratorFactory::class);
    }
```

## Usage
Follow the steps below on how to use the shift-code-generator:

#### How to use the Library
How to generate the code...

```php
   use ShiftechAfrica\CodeGenerator\ShiftCodeGenerator;
   /**
     * ----------------------------
     * Generate the code here
     * -----------------------------------------------------------------------
     * Code will be generated in the format of Y-M-D + 7 random characters
     * -----------------------------------------------------------------------
     * @return string
     */
    public function generateCode()
    {
        return (new ShiftCodeGenerator())->generate();// in the generate method you can pass an int value like 5,4 or any to get the length of the code you want
    }
```


## Version Guidance

| Version | Status     | Packagist           | Namespace    | Repo                |
|---------|------------|---------------------|--------------|---------------------|
| 1.x     | Latest     | `shiftechafrica/shift-code-generator` | `ShiftechAfrica\CodeGenerator` | [v1.2.2](https://github.com/dev-techguy/laravel-multiple-guards/releases/tag/v1.2.2)|

[shift-code-generator-repo]: https://github.com/dev-techguy/laravel-multiple-guards.git

## Security Vulnerabilities
 For any security vulnerabilities, please email to [Shiftech Africa](mailto:bugs@shiftechafrica.com).
 
## License
 This package is open-source, licensed under the [MIT license](https://opensource.org/licenses/MIT).
