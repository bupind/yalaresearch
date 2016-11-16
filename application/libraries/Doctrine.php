<?php

use Doctrine\Common\ClassLoader;
use Doctrine\Common\EventManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\DBAL\Event\Listeners\MysqlSessionInit;
use Gedmo\Timestampable\TimestampableListener;
use Gedmo\Sluggable\SluggableListener;
use Gedmo\Tree\TreeListener;

(defined('BASEPATH')) || exit('No direct script access allowed');

/**
* Doctrine Class
*
* This class is wrapper/bootstrap for the D2 entity manager.
*
* Based on http://doctrine-orm.readthedocs.org/en/latest/cookbook/integrating-with-codeigniter.html
*/
class Doctrine
{
    public $em = null;
    public $tool = null;
    
    function __construct()
    {
        CI::$APP->benchmark->mark('doctrine_load_start');

        // load database configuration from CodeIgniter
        if (! file_exists($db_config_file = APPPATH . 'config/' . ENVIRONMENT . '/database'.EXT)
            && ! file_exists($db_config_file = APPPATH . 'config/database'.EXT)) {
            show_error('The configuration file database'.EXT.' does not exist.');
        }
        require $db_config_file;

        if (! isset($active_group) || ! isset($db[$active_group])) {
            show_error('You have specified an invalid database connection group.');
        }

        // Set up class loading. You could use different autoloaders, provided by your favorite framework,
        // if you want to.

        // load the Doctrine classes        
        $doctrineClassLoader = new ClassLoader('Doctrine',  APPPATH.'../vendor');
        $doctrineClassLoader->register();

        // Set up Gedmo
        $classLoader = new ClassLoader('Gedmo', APPPATH.'../vendor');
        $classLoader->register();

        // load the entities
        $entitiesClassLoader = new ClassLoader('Entities', rtrim(APPPATH, '/'));
        $entitiesClassLoader->register();

        // load the proxy entities
        $proxiesClassLoader = new ClassLoader('Proxies', APPPATH . 'models/Proxies');
        $proxiesClassLoader->register();

        // load Symfony2 classes
        // this is necessary for YAML mapping files and for Command Line Interface (cli-doctrine.php)
        $symfonyClassLoader = new ClassLoader('Symfony',  APPPATH.'../vendor/Doctrine');
        $symfonyClassLoader->register();

        // for HMVC : Uncomment these lines
        foreach (glob(APPPATH . 'modules/*', GLOB_ONLYDIR) as $m) {
            $module = str_replace(APPPATH . 'modules/', '', $m);
            $loader = new ClassLoader($module, APPPATH . 'modules');
            $loader->register();
        }

        $evm = new EventManager;
        // timestampable
        $evm->addEventSubscriber(new TimestampableListener);
        // sluggable
        $evm->addEventSubscriber(new SluggableListener);
        // tree
        $evm->addEventSubscriber(new TreeListener);

        // Set up the configuration
        $config = new Configuration;

        // Set up caches
        if(ENVIRONMENT == 'development') {
            // set up simple array caching for development mode
            $cache = new \Doctrine\Common\Cache\ArrayCache;
        } else {
            // set up caching with APC for production mode
            $cache = new \Doctrine\Common\Cache\ApcCache; 
        }

        $config->setMetadataCacheImpl($cache);
        $config->setQueryCacheImpl($cache);

        // set up annotation driver
        $driverImpl = $config->newDefaultAnnotationDriver(array(APPPATH . 'models/Entities'));
        $config->setMetadataDriverImpl($driverImpl);
        
        $config->setQueryCacheImpl($cache);

        // Proxy configuration
        $config->setProxyDir(APPPATH . '/models/Proxies');
        $config->setProxyNamespace('Proxies');

        // Set up logger
        $logger = new EchoSQLLogger;
        $config->setSQLLogger($logger);

        if (ENVIRONMENT == "development") {
            $config->setAutoGenerateProxyClasses( TRUE );
        } else {
            $config->setAutoGenerateProxyClasses( FALSE );
        }

        // Database connection information
        $connectionOptions = $this->convertDbConfig($db[$active_group]);

        // Create EntityManager, and store it for use in our CodeIgniter controllers
        $this->em = EntityManager::create($connectionOptions, $config);

        // Force UTF-8
        $this->em->getEventManager()->addEventSubscriber( new MysqlSessionInit('utf8', 'utf8_unicode_ci'));

        // Schema Tool
        // $this->tool = new SchemaTool($this->em);

        CI::$APP->benchmark->mark('doctrine_load_end');

        log_message('info', 'Doctrine Wrapper/Bootstrap Class Initialized');
    }

    /**
     * Convert CodeIgniter database config array to Doctrine's
     * 
     * See http://www.codeigniter.com/user_guide/database/configuration.html
     * See http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
     * 
     * @param array $db
     * @return array
     * @throws Exception
     */
    public function convertDbConfig($db)
    {
        $connectionOptions = [];
        if ($db['dbdriver'] === 'pdo') {
            return $this->convertDbConfigPdo($db);
        } elseif ($db['dbdriver'] === 'mysqli') {
            $connectionOptions = [
                'driver'   => $db['dbdriver'],
                'user'     => $db['username'],
                'password' => $db['password'],
                'host'     => $db['hostname'],
                'dbname'   => $db['database'],
                'charset'  => $db['char_set'],
            ];
        } else {
            show_error('Your Database Configuration is not confirmed by CodeIgniter Doctrine');
        }
        return $connectionOptions;
    }

    protected function convertDbConfigPdo($db)
    {
        $connectionOptions = [];
        if (substr($db['hostname'], 0, 7) === 'sqlite:') {
            $connectionOptions = [
                'driver'   => 'pdo_sqlite',
                'user'     => $db['username'],
                'password' => $db['password'],
                'path'     => preg_replace('/\Asqlite:/', '', $db['hostname']),
            ];
        } elseif (substr($db['dsn'], 0, 7) === 'sqlite:') {
            $connectionOptions = [
                'driver'   => 'pdo_sqlite',
                'user'     => $db['username'],
                'password' => $db['password'],
                'path'     => preg_replace('/\Asqlite:/', '', $db['dsn']),
            ];
        } elseif (substr($db['dsn'], 0, 6) === 'mysql:') {
            $connectionOptions = [
                'driver'   => 'pdo_mysql',
                'user'     => $db['username'],
                'password' => $db['password'],
                'host'     => $db['hostname'],
                'dbname'   => $db['database'],
                'charset'  => $db['char_set'],
            ];
        } else {
            show_error('Your Database Configuration is not confirmed by CodeIgniter Doctrine');
        }
        return $connectionOptions;
    }
}