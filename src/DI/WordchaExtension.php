<?php declare(strict_types = 1);

namespace Contributte\Wordcha\DI;

use Contributte\Wordcha\DataSource\DataSource;
use Contributte\Wordcha\DataSource\NumericDataSource;
use Contributte\Wordcha\DataSource\QuestionDataSource;
use Contributte\Wordcha\Factory;
use Contributte\Wordcha\WordchaFactory;
use Contributte\Wordcha\WordchaUniqueFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Utils\AssertionException;

final class WordchaExtension extends CompilerExtension
{

	/** @var string[] */
	private static $dataSources = [
		'numeric',
		'questions',
	];

	/** @var mixed[] */
	private $defaults = [
		'auto' => true,
		'datasource' => 'numeric',
		'questions' => [],
	];

	/** @var bool */
	private $debugMode;

	public function __construct(bool $debugMode = false)
	{
		$this->debugMode = $debugMode;
	}

	/**
	 * Register services
	 *
	 * @throws AssertionException
	 */
	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->validateConfig($this->defaults);

		// Validate dataSource
		if (!in_array($config['datasource'], self::$dataSources, true)) {
			throw new AssertionException(
				'DataSource is not valid. Valid datasources are ' . implode(', ', self::$dataSources)
			);
		}

		// Add datasource
		$dataSource = $builder->addDefinition($this->prefix('dataSource'))
			->setType(DataSource::class);

		if ($config['datasource'] === 'numeric') {
			$dataSource->setFactory(NumericDataSource::class);
		} elseif ($config['datasource'] === 'questions') {
			$dataSource->setFactory(QuestionDataSource::class, [$config['questions']]);
		}

		// Add factory
		$factory = $builder->addDefinition($this->prefix('factory'))
			->setType(Factory::class);
		if ($this->debugMode) {
			$factory->setFactory(WordchaFactory::class, [$dataSource]);
		} else {
			$uniqueKey = sha1(random_bytes(10) . microtime(true));
			$factory->setFactory(WordchaUniqueFactory::class, [$dataSource, $uniqueKey]);
		}
	}

	public function afterCompile(ClassType $class): void
	{
		$config = $this->validateConfig($this->defaults);

		if ($config['auto'] === true) {

			$method = $class->getMethod('initialize');
			$method->addBody(
				'?::bind($this->getService(?));',
				[
					new PhpLiteral(FormBinder::class),
					$this->prefix('factory'),
				]
			);
		}
	}

}
