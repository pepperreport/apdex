<?php

declare(strict_types=1);

namespace Pepperreport\Apdex;

interface MetricInterface
{
    public function getResponseTime(): int;
}
