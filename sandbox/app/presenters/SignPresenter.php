<?php

namespace App\Presenters;

use Nette\Forms\Form;

class SignPresenter extends BasePresenter
{

	protected function createComponentForm()
	{
		$form = new Form();

		$form->addWordcha('wordcha')
			->getQuestion()
			->setRequired('Captcha code is required');

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

}
