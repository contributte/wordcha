# Wordcha

## Content

- [Usage - how to register](#usage)
- [Extension - how to configure](#configuration)
- [Form - setup nette form](#form)
- [Example - real preview](#example)

## Usage

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

## Form

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
