<?php
/**
 * Container implementation.
 *
 * PHP Version 5
 *
 * @category Ding
 * @package  Container
 * @author   Marcelo Gornstein <marcelog@gmail.com>
 * @license  http://www.noneyet.ar/ Apache License 2.0
 * @version  SVN: $Id$
 * @link     http://www.noneyet.ar/
 */
namespace Ding\Container\Impl;

use Ding\Container\IContainer;
use Ding\Component\BeanDefinition;
use Ding\Component\BeanList;
use Ding\Component\BeanPropertyDefinition;
use Ding\Component\Factory\BeanFactory;
use Ding\Component\Factory\Impl\BeanFactoryXmlImpl;
use Ding\Component\Exception\BeanListException;
use Ding\Container\Exception\ContainerException;
use Ding\Aspect\Proxy;
use Ding\Aspect\InterceptorDefinition;

/**
 * Container implementation.
 *
 * PHP Version 5
 *
 * @category Ding
 * @package  Container
 * @author   Marcelo Gornstein <marcelog@gmail.com>
 * @license  http://www.noneyet.ar/ Apache License 2.0
 * @link     http://www.noneyet.ar/
 */
class ContainerImpl implements IContainer
{
    /**
     * Bean factory
     * @var IBeanFactory
     */
    private $_factory = false;
    
    /**
     * Container instance.
     * @var ContainerImpl
     */
    private static $_containerInstance = false;

    /**
     * Returns factory in use.
	 * @return IBeanFactory
     */
    private function _getFactory()
    {
        return $this->_factory;
    }

    public function getBean($bean)
    {
        $factory = $this->_getFactory();
        return $factory->getBean($bean);
    }
    
    public static function getInstanceFromXml($filename)
    {
        return
            self::$_containerInstance === false
            ? new ContainerImpl(new BeanFactoryXmlImpl($filename))
            : self::$_containerInstance
        ;
    }

    protected function __construct(BeanFactory $factory)
    {
        $this->_beans = array();
        $this->_factory = $factory;
        self::$_containerInstance = $this;
    }
}