<?php

namespace App\Presenters;

use App\Forms;
use Nette;


class SignPresenter extends BasePresenter
{
    /** @var Forms\SignInFormFactory @inject */
    public $signInFactory;

    /** @var Forms\SignUpFormFactory @inject */
    public $signUpFactory;


    /**
     * Sign-in form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignInForm()
    {
        return $this->signInFactory->create(function () {
            $this->redirect('Homepage:');
        });
    }


    /**
     * Sign-up form factory.
     * @return Nette\Application\UI\Form
     */
    protected function createComponentSignUpForm()
    {
        return $this->signUpFactory->create(function () {
            $this->redirect('Homepage:');
        });
    }


    public function actionOut()
    {
        $this->getUser()->logout();
    }

}
