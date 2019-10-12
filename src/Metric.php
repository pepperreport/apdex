<?php

namespace Pepperreport\Apdex;

class Metric implements MetricInterface
{
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
