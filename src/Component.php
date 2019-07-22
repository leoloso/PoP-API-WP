<?php
namespace PoP\BootstrapWP;

use PoP\Root\Component\AbstractComponent;
use PoP\Root\Dotenv\DotenvBuilderFactory;

/**
 * Initialize component
 */
class Component extends AbstractComponent
{
    /**
     * Initialize services
     */
    public static function init()
    {
        parent::init();
        
        // Load environment variables from this package's configuration folder
        DotenvBuilderFactory::setFileLocation(dirname(__DIR__).'/config');
    }
}
