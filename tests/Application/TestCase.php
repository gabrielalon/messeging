<?php

namespace N3tt3ch\Messaging\Test\Application;

use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Psr\Container\ContainerInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

abstract class TestCase extends PHPUnitTestCase
{
	/** @var ContainerInterface */
	private $container;
	
	/**
	 * @param string $key
	 * @return mixed|object|null
	 */
	protected function getFromContainer(string $key)
	{
		if (null === $this->container)
		{
			$container = new ContainerBuilder();
			$loader = new YamlFileLoader($container, new FileLocator('../../config'));
			$loader->load('core.yaml');
			$loader->load('services.yaml');
			
			$this->container = $container;
		}
		
		return $this->container->get($key);
	}
}