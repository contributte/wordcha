<?php
namespace Minetro\Wordcha\DI;

use Minetro\Wordcha\DataSource\NumericDataSource;
use Minetro\Wordcha\DataSource\QuestionDataSource;
use Minetro\Wordcha\WordchaFactory;
use Minetro\Wordcha\WordchaUniqueFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Utils\Validators;

final class WordchaExtension extends CompilerExtension
{
    /** @var array */
    private $defaults = [
        'datasource' => 'numeric',
        'questions' => []
    ];

    /** @var array */
    private static $dataSources = [
        'numeric',
    ];

    /**
     * @var bool
     */
    private $debugMode;

    public function __construct($debugMode = false)
    {
        $this->debugMode = $debugMode;
    }

    /**
     * Register services
     */
    public function loadConfiguration()
    {
        $builder = $this->getContainerBuilder();
        $config = $this->validateConfig($this->defaults);

        // Validate dataSource
        Validators::isInRange($config['datasource'], self::$dataSources);

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
            $uniqueKey = md5(random_bytes(1)); //TODO
            $factory->setClass(WordchaUniqueFactory::class, [$dataSource, $uniqueKey]);
        }
    }

    /**
     * @param ClassType $class
     */
    public function afterCompile(ClassType $class)
    {
        $method = $class->getMethod('initialize');
        $method->addBody('?::bind($this->getService(?));', [new PhpLiteral(FormBinder::class), $this->prefix('factory')]);
    }
}