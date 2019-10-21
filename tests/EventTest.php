<?php

namespace N3ttech\Messaging\Test;

use N3ttech\Messaging\Event;
use N3ttech\Messaging\Snapshot;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @internal
 * @coversNothing
 */
class EventTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function itCreatesDefaultEventObjectsTest()
    {
        $eventRouterFactory = new Event\EventRouting\EventRouterFactory();
        $eventTransporterFactory = new Event\EventTransporting\EventTransporterFactory(
            $eventRouterFactory->fromArray([]),
            new Event\EventSourcing\EventProjectionProvider\Containerized()
        );

        $eventBus = new Event\EventBus($eventTransporterFactory->createDefault());

        $snapshotStorage = new Snapshot\SnapshotStore\SnapshotStorage(new Snapshot\Persist\InMemorySnapshotRepository());

        $eventStorageFactory = new Event\EventStore\EventStorageFactory(new Event\Persist\InMemoryEventStreamRepository());
        $eventStorage = $eventStorageFactory->create($eventBus);

        $this->assertInstanceOf(Event\EventBus::class, $eventBus);
        $this->assertInstanceOf(Snapshot\SnapshotStore\SnapshotStorage::class, $snapshotStorage);
        $this->assertInstanceOf(Event\EventStore\EventStorage::class, $eventStorage);
    }
}
