<?php

declare(strict_types=1);

namespace Pepperreport\Apdex;

class Metric implements MetricInterface
{
    /**
     * @var int
     */
    private $responseTime;

    public function setResponseTime(int $responseTime)
    {
        $this->responseTime = $responseTime;

        return $this;
    }

    public function getResponseTime(): int
    {
        return $this->responseTime;
    }
}
