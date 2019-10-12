<?php

namespace Pepperreport\Apdex;

class ApdexDetail
{
    private $apdexCounters;
    private $processedApdex;
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

    public function getSatisfiedPercent()
    {
        return (100/$this->totalMetrics)*$this->apdexCounters['u'];
    }

    public function getToleratedPercent()
    {
        return (100/$this->totalMetrics)*$this->apdexCounters['t'];
    }

    public function getFrustratedPercent()
    {
        return (100/$this->totalMetrics)*$this->apdexCounters['i'];
    }
}
