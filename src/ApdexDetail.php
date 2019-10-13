<?php

declare(strict_types=1);

namespace Pepperreport\Apdex;

class ApdexDetail
{
    /**
     * @var int
     */
    private $apdexCounters;

    /**
     * @var array|null
     */
    private $processedApdex;

    /**
     * @var int
     */
    private $totalMetrics;

    public function __construct($apdexCounters = 0, $processedApdex = null, $totalMetrics = 1)
    {
        $this->apdexCounters = $apdexCounters;
        $this->processedApdex = ($processedApdex) ? $processedApdex : ['u' => 0, 't' => 0, 'i' => 0];
        $this->totalMetrics = $totalMetrics;
    }

    public function getApdex()
    {
        return $this->processedApdex;
    }

    public function getSatisfiedPercent(): int
    {
        return (100 / $this->totalMetrics) * $this->apdexCounters['u'];
    }

    public function getToleratedPercent(): int
    {
        return (100 / $this->totalMetrics) * $this->apdexCounters['t'];
    }

    public function getFrustratedPercent(): int
    {
        return (100 / $this->totalMetrics) * $this->apdexCounters['i'];
    }
}
