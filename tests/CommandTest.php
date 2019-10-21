<?php

namespace N3ttech\Messaging\Test;

use N3ttech\Messaging\Command;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @internal
 * @coversNothing
 */
class CommandTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function itCreatesDefaultCommandObjectsTest()
    {
        $commandHandlerProvider = new Command\CommandHandling\CommandHandlerProvider\Containerized();
        $commandRouterFactory = new Command\CommandRouting\CommandRouterFactory($commandHandlerProvider);
        $commandTransporterFactory = new Command\CommandTransporting\CommandTransporterFactory($commandRouterFactory->createDefault());

        $commandBus = new Command\CommandBus($commandTransporterFactory->createDefault());

        $this->assertInstanceOf(Command\CommandBus::class, $commandBus);
    }
}
