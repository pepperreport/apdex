<?php

namespace Pepperreport\Apdex;

class ApdexProcessor
{
    private $metrics;

    private $baseApdex;

    private $apdexTotal;

    private $minResponseTime = 0;
    private $maxResponseTime = 0;

    public function __construct(array $metrics, int $baseApdex = 500)
    {
        $this->metrics = $metrics;
        $this->baseApdex = $baseApdex;
    }

    public function process()
    {
        $baseApdexT = $this->baseApdex*4;
        $apdexIndice = ['u' => 0, 't' => 0, 'i' => 0];
        foreach ($this->metrics as $metric) {
            $responseTime += $metric->getResponseTime();

            if ($metric->getResponseTime() == 0) {
                $apdexIndice['i']++;
            } elseif ($metric->getResponseTime() < $this->baseApdex) {
                $apdexIndice['u']++;
            } elseif ($metric->getResponseTime() < $baseApdexT) {
                $apdexIndice['t']++;
            } else {
                $apdexIndice['i']++;
            }

            if ($this->minResponseTime>$metric->getResponseTime() || $this->minResponseTime == null) {
                $this->minResponseTime = $metric->getResponseTime();
            }
            if ($this->maxResponseTime<$metric->getResponseTime()) {
                $this->maxResponseTime = $metric->getResponseTime();
            }
        }

        if ($apdexIndice['t'] > 0 || $apdexIndice['i'] > 0) {
            $this->apdexTotal = ($apdexIndice['u'] + $apdexIndice['t'] / 2 )/ count($this->metrics);
        } else {
            $this->apdexTotal = 1;
        }

        return new ApdexDetail($apdexIndice, $this->apdexTotal, count($this->metrics));
    }
}
