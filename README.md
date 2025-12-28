![](https://heatbadger.now.sh/github/readme/contributte/wordcha/?deprecated=1)

<p align=center>
    <a href="https://bit.ly/ctteg"><img src="https://badgen.net/badge/support/gitter/cyan"></a>
    <a href="https://bit.ly/cttfo"><img src="https://badgen.net/badge/support/forum/yellow"></a>
    <a href="https://contributte.org/partners.html"><img src="https://badgen.net/badge/sponsor/donations/F96854"></a>
</p>

<p align=center>
    Website 🚀 <a href="https://contributte.org">contributte.org</a> | Contact 👨🏻‍💻 <a href="https://f3l1x.io">f3l1x.io</a> | Twitter 🐦 <a href="https://twitter.com/contributte">@contributte</a>
</p>

## Disclaimer

| :warning: | This project is no longer being maintained.
|---|---|

| Composer | [`contributte/wordcha`](https://packagist.org/packages/contributte/wordcha) |
|---|---|
| Version | ![](https://badgen.net/packagist/v/contributte/wordcha) |
| PHP | ![](https://badgen.net/packagist/php/contributte/wordcha) |
| License | ![](https://badgen.net/github/license/contributte/wordcha) |

## About

Question-based captcha for Nette Framework / Forms.

## Installation

```bash
composer require contributte/wordcha
```

Register extension:

```yaml
extensions:
    wordcha: Contributte\Wordcha\DI\WordchaExtension
```

## Configuration

At the beginning you should pick the right datasource.

### Numeric datasource

```yaml
wordcha:
    datasource: numeric
```

### Question datasource

```yaml
wordcha:
    datasource: questions
    questions:
        "Question a?": "a"
        "Question b?": "b"
```

## Usage

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

## Example

![captcha](https://raw.githubusercontent.com/contributte/wordcha/master/.docs/wordcha.png)

## Versions

| State       | Version | Branch   | PHP     |
|-------------|---------|----------|---------|
| dev         | `^0.5`  | `master` | `>=8.1` |
| stable      | `^0.4`  | `master` | `>=8.1` |

## Development

This package was maintained by these authors.

<a href="https://github.com/f3l1x">
  <img width="80" height="80" src="https://avatars2.githubusercontent.com/u/538058?v=3&s=80">
</a>

-----

Consider to [support](https://contributte.org/partners.html) **contributte** development team.
Also thank you for using this package.
