<?php

namespace Pepperreport\Apdex;

interface MetricInterface
{
    public function getResponseTime(): int;
}
