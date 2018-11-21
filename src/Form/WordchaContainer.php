<?php declare(strict_types = 1);

namespace Contributte\Wordcha\Form;

use Contributte\Wordcha\Factory;
use Contributte\Wordcha\Generator\Generator;
use Contributte\Wordcha\Validator\Validator;
use Nette\Forms\Container;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\Strings;

class WordchaContainer extends Container
{

	/** @var Validator */
	private $validator;

	/** @var Generator */
	private $generator;

	public function __construct(Factory $factory)
	{
		parent::__construct();

		$this->validator = $factory->createValidator();
		$this->generator = $factory->createGenerator();

		$security = $this->generator->generate();

		$textInput = new TextInput($security->getQuestion());
		$textInput->setRequired(true);

		$hiddenField = new HiddenField($security->getHash());

		$this['question'] = $textInput;
		$this['hash'] = $hiddenField;
	}

	public function getQuestion(): TextInput
	{
		return $this['question'];
	}

	public function getHash(): HiddenField
	{
		return $this['hash'];
	}

	public function verify(): bool
	{
		$form = $this->getForm(true);
		$hash = $form->getHttpData($form::DATA_LINE, $this->getHash()->getHtmlName());
		$answer = $form->getHttpData($form::DATA_LINE, $this->getQuestion()->getHtmlName());
		$answer = Strings::lower($answer);

		return $this->validator->validate($answer, $hash);
	}

	public function getValidator(): Validator
	{
		return $this->validator;
	}

	public function getGenerator(): Generator
	{
		return $this->generator;
	}

}
