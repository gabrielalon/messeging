##Library for handling CQRS and ES

1. Define event bus

```php

use N3tt3ch\Messaging\Event;

$eventRouterFactory = new Event\EventRouting\EventRouterFactory();
$eventTransporterFactory = new Event\EventTransporting\EventTransporterFactory(
	$eventRouterFactory->fromDirectory('path to directory with event map'),
	new Event\EventSourcing\EventProjectionProvider($container)
);

$eventBus = new Event\EventBus($eventTransporterFactory->createDefault());
```

Further we need to create event storage and event stream

```php
use N3tt3ch\Messaging\Event;
use N3tt3ch\Messaging\Snapshot;

$snapshotStorage = new Snapshot\SnapshotStore\SnapshotStorage($container->get(Snapshot\Persist\SnapshotRepository::class));
$eventStorageFactory = new Event\EventStore\EventStorageFactory($container->get(Event\Persist\EventStreamRepository::class));
$eventStorage = $eventStorageFactory->create($eventBus);

$someAggregateRepository = new SomeAggregateRepository($eventStorage, $snapshotStorage);
```

2. Define command bus

```php
use N3tt3ch\Messaging\Command;

$commandHandlerProvider = new Command\CommandHandling\CommandHandlerProvider($container);
$commandRouterFactory = new Command\CommandRouting\CommandRouterFactory($commandHandlerProvider);
$commandTransporterFactory = new Command\CommandTransporting\CommandTransporterFactory($commandRouterFactory->createDefault());

$commandBus = new Command\CommandBus($commandTransporterFactory->createDefault());
```

3. Define query bus

```php
use N3tt3ch\Messaging\Query;

$queryHandlerProvider = new Query\QueryHandling\QueryHandlerProvider($container);
$queryRouterFactory = new Query\QueryRouting\QueryRouterFactory($queryHandlerProvider);
$queryTransporterFactory = new Query\QueryTransporting\QueryTransporterFactory($queryRouterFactory->createDefault());

$queryBus = new Query\QueryBus($queryTransporterFactory->createDefault());
```

You can use your own message transports.
You can use your own message naming strategies.

Please view transport and routing factories.
