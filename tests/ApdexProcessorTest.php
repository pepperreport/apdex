<?php

namespace Pepperreport\Apdex;

use PHPUnit\Framework\TestCase;
use Pepperreport\Apdex\ApdexProcessor;
use Pepperreport\Apdex\Metric;

class ApdexProcessorTest extends TestCase
{
    /**
     * @test
     */
    public function process_apdex()
    {
        $metrics = [];
        for ($i=0; $i < 60; $i++) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(rand(100, 600));
        }

        for ($i=0; $i < 30; $i++) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(rand(3100, 11900));
        }
        for ($i=0; $i < 10; $i++) {
            $m = new Metric();
            $metrics[] = $m->setResponseTime(rand(12100, 20000));
        }

        $apdexProcessor = new ApdexProcessor($metrics, 3000);
        $apdexDetail = $apdexProcessor->process();

        $this->assertEquals(0.75, $apdexDetail->getApdex());
    }
}
