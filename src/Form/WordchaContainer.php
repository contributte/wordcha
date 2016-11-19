<?php

namespace Minetro\Wordcha\Form;

use Minetro\Wordcha\Factory;
use Minetro\Wordcha\Generator\Generator;
use Minetro\Wordcha\Validator\Validator;
use Nette\Forms\Container;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\Strings;

/**
 * Class WordchaContainer
 *
 * @package Minetro\Wordcha\Form
 */
class WordchaContainer extends Container
{

	/** @var Validator */
	private $validator;

	/** @var Generator */
	private $generator;

	/**
	 * WordchaContainer constructor.
	 *
	 * @param Factory $factory
	 */
	public function __construct(Factory $factory)
	{
		parent::__construct();

		$this->validator = $factory->createValidator();
		$this->generator = $factory->createGenerator();

		$security = $this->generator->generate();

		$textInput   = new TextInput($security->getQuestion());
		$hiddenField = new HiddenField($security->getHash());

		$this['question'] = $textInput;
		$this['hash']     = $hiddenField;
	}

	/**
	 * @return TextInput
	 */
	public function getQuestion()
	{
		return $this['question'];
	}

	/**
	 * @return HiddenField
	 */
	public function getHash()
	{
		return $this['hash'];
	}

	/**
	 * @return bool
	 */
	public function verify()
	{
		$form   = $this->getForm(TRUE);
		$hash   = $form->getHttpData($form::DATA_LINE, $this->getHash()->getHtmlName());
		$answer = $form->getHttpData($form::DATA_LINE, $this->getQuestion()->getHtmlName());
		$answer = Strings::lower($answer);

		return $this->validator->validate($answer, $hash);
	}

	/**
	 * @return Validator
	 */
	public function getValidator()
	{
		return $this->validator;
	}

	/**
	 * @return Generator
	 */
	public function getGenerator()
	{
		return $this->generator;
	}

}
