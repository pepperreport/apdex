<?php

declare(strict_types=1);

namespace Pepperreport\Apdex;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @small
 */
final class ApdexProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function process_apdex(): void
    {
        $metrics = [];
        for ($i = 0; $i < 60; ++$i) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(random_int(100, 600));
        }

        for ($i = 0; $i < 30; ++$i) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(random_int(3100, 11900));
        }
        for ($i = 0; $i < 10; ++$i) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(random_int(12100, 20000));
        }

        $apdexProcessor = new ApdexProcessor($metrics, 3000);
        $apdexDetail = $apdexProcessor->process();

        self::assertEquals(0.75, $apdexDetail->getApdex());
    }
}
