# Wordcha

[![Build Status](https://img.shields.io/travis/minetro/wordcha.svg?style=flat-square)](https://travis-ci.org/minetro/wordcha)
[![Code coverage](https://img.shields.io/coveralls/minetro/wordcha.svg?style=flat-square)](https://coveralls.io/r/minetro/wordcha)
[![Downloads this Month](https://img.shields.io/packagist/dm/minetro/wordcha.svg?style=flat-square)](https://packagist.org/packages/minetro/wordcha)
[![Downloads total](https://img.shields.io/packagist/dt/minetro/wordcha.svg?style=flat-square)](https://packagist.org/packages/minetro/wordcha)
[![Latest stable](https://img.shields.io/packagist/v/minetro/wordcha.svg?style=flat-square)](https://packagist.org/packages/minetro/wordcha)
[![HHVM Status](https://img.shields.io/hhvm/minetro/wordcha.svg?style=flat-square)](http://hhvm.h4cc.de/package/minetro/wordcha)

Numeric\question captcha for Nette Framework / Forms.

## Discussion / Help

[![Join the chat](https://img.shields.io/gitter/room/minetro/nette.svg?style=flat-square)](https://gitter.im/minetro/nette?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Install

```sh
composer require minetro/wordcha
```

## Extension

```yaml
extensions:
	wordcha: Minetro\Wordcha\DI\WordchaExtension
```

## DataSource

### Numeric

```yaml
wordcha:
	datasource: numeric
```

### Questions

```yaml
wordcha:
	datasource: questions
	questions: 
		"Question a?": "a"
		"Question b?": "b"
```

## Usage

![captcha](https://raw.githubusercontent.com/minetro/wordcha/master/wordcha.png)

### Form component

```php
use Nette\Application\UI\Form;

protected function createComponentForm()
{
    $form = new Form();

    $form->addWordcha('wordcha')
        ->getQuestion()
        ->setRequired('Please answer antispam question');

    $form->addSubmit('send');

    $form->onValidate[] = function (Form $form) {
        if ($form['wordcha']->verify() !== TRUE) {
            $form->addError('Are you robot?');
        }
    };

    $form->onSuccess[] = function (Form $form) {
        dump($form['wordcha']);
    };

    return $form;
}
```

### Rendering

```
{control form}
````

-----

Thanks for testing, reporting and contributing.
