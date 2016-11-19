<?php
namespace Minetro\Wordcha\DI;

use Minetro\Wordcha\DataSource\NumericDataSource;
use Minetro\Wordcha\DataSource\QuestionDataSource;
use Minetro\Wordcha\WordchaFactory;
use Minetro\Wordcha\WordchaUniqueFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Utils\AssertionException;

/**
 * Class WordchaExtension
 *
 * @package Minetro\Wordcha\DI
 */
final class WordchaExtension extends CompilerExtension
{

	/** @var array */
	private $defaults = [
		'auto'       => TRUE,
		'datasource' => 'numeric',
		'questions'  => [],
	];

	/** @var array */
	private static $dataSources = [
		'numeric',
		'questions',
	];

	/** @var bool */
	private $debugMode;

	/**
	 * WordchaExtension constructor.
	 *
	 * @param bool $debugMode
	 */
	public function __construct($debugMode = FALSE)
	{
		$this->debugMode = $debugMode;
	}

	/**
	 * Register services
	 *
	 * @throws AssertionException
	 * @return void
	 */
	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$config  = $this->validateConfig($this->defaults);

		// Validate dataSource
		if (!in_array($config['datasource'], self::$dataSources)) {
			throw new AssertionException(
				'DataSource is not valid. Valid datasources are ' . implode(', ', self::$dataSources)
			);
		}

		// Add datasource
		$dataSource = $builder->addDefinition($this->prefix('dataSource'));

		if ($config['datasource'] == 'numeric') {
			$dataSource->setClass(NumericDataSource::class);
		} elseif ($config['datasource'] == 'questions') {
			$dataSource->setClass(QuestionDataSource::class, [$config['questions']]);
		}

		// Add factory
		$factory = $builder->addDefinition($this->prefix('factory'));
		if ($this->debugMode) {
			$factory->setClass(WordchaFactory::class, [$dataSource]);
		} else {
			$uniqueKey = sha1(random_bytes(10) . microtime(TRUE));
			$factory->setClass(WordchaUniqueFactory::class, [$dataSource, $uniqueKey]);
		}
	}

	/**
	 * @param ClassType $class
	 *
	 * @return void
	 */
	public function afterCompile(ClassType $class)
	{
		$config = $this->validateConfig($this->defaults);

		if ($config['auto']) {

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
