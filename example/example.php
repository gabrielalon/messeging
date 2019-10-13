<?php

include '../vendor/autoload.php';

use N3tt3ch\Messaging\Aggregate;
use N3tt3ch\Messaging\Command;
use N3tt3ch\Messaging\Event;
use N3tt3ch\Messaging\Query;
use N3tt3ch\Messaging\Snapshot;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator('../config'));
$loader->load('services.yaml');

class SomeAggregate extends Aggregate\AggregateRoot
{}

class SomeAggregateRepository extends Aggregate\Persist\AggregateRepository
{
	/**
	 * @return string
	 */
	public function getAggregateRootClass(): string
	{
		return SomeAggregate::class;
	}
}

// -------------------------- EVENT ---------------------------------------------

$eventRouterFactory = new Event\EventRouting\EventRouterFactory();
$eventTransporterFactory = new Event\EventTransporting\EventTransporterFactory(
	$eventRouterFactory->fromDirectory(__DIR__ . DIRECTORY_SEPARATOR . 'events'),
	new Event\EventSourcing\EventProjectionProvider($container)
);

$eventBus = new Event\EventBus($eventTransporterFactory->createDefault());

$snapshotStorage = new Snapshot\SnapshotStore\SnapshotStorage($container->get(Snapshot\Persist\SnapshotRepository::class));
$eventStorageFactory = new Event\EventStore\EventStorageFactory($container->get(Event\Persist\EventStreamRepository::class));
$eventStorage = $eventStorageFactory->create($eventBus);

$someAggregateRepository = new SomeAggregateRepository($eventStorage, $snapshotStorage);

// -------------------------- COMMAND ---------------------------------------------

$commandHandlerProvider = new Command\CommandHandling\CommandHandlerProvider($container);
$commandRouterFactory = new Command\CommandRouting\CommandRouterFactory($commandHandlerProvider);
$commandTransporterFactory = new Command\CommandTransporting\CommandTransporterFactory($commandRouterFactory->createDefault());

$commandBus = new Command\CommandBus($commandTransporterFactory->createDefault());


// -------------------------- QUERY ---------------------------------------------

$queryHandlerProvider = new Query\QueryHandling\QueryHandlerProvider($container);
$queryRouterFactory = new Query\QueryRouting\QueryRouterFactory($queryHandlerProvider);
$queryTransporterFactory = new Query\QueryTransporting\QueryTransporterFactory($queryRouterFactory->createDefault());

$queryBus = new Query\QueryBus($queryTransporterFactory->createDefault());