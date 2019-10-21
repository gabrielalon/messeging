<?php

namespace N3ttech\Messaging\Test;

use N3ttech\Messaging\Query;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;

/**
 * @internal
 * @coversNothing
 */
class QueryTest extends PHPUnitTestCase
{
    /**
     * @test
     */
    public function itCreatesDefaultQueryObjectsTest()
    {
        $queryHandlerProvider = new Query\QueryHandling\QueryHandlerProvider\Containerized();
        $queryRouterFactory = new Query\QueryRouting\QueryRouterFactory($queryHandlerProvider);
        $queryTransporterFactory = new Query\QueryTransporting\QueryTransporterFactory($queryRouterFactory->createDefault());

        $queryBus = new Query\QueryBus($queryTransporterFactory->createDefault());

        $this->assertInstanceOf(Query\QueryBus::class, $queryBus);
    }
}
