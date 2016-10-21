<?php

namespace App\Forms;

use Nette;
use Nette\Application\UI\Form;
use Nette\Security\User;


class SignInFormFactory
{

    /** @var FormFactory */
    private $factory;

    /** @var User */
    private $user;


    public function __construct(FormFactory $factory, User $user)
    {
        $this->factory = $factory;
        $this->user = $user;
    }


    /**
     * @return Form
     */
    public function create(callable $onSuccess)
    {
        $form = $this->factory->create();


        $form->addWordcha('aa');

        $form->addCheckbox('remember', 'Keep me signed in');

        $form->addSubmit('send', 'Sign in');


        $form->onSuccess[] = function (Form $form, $values) use ($onSuccess) {
            try {

                var_dump($form['aa']->verify());
                exit;

                // $this->user->setExpiration($values->remember ? '14 days' : '20 minutes');
                // $this->user->login($values->username, $values->password);
            } catch (Nette\Security\AuthenticationException $e) {
                $form->addError('The username or password you entered is incorrect.');
                return;
            }
            $onSuccess();
        };
        return $form;
    }

}
