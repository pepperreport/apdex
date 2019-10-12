<?php

declare(strict_types=1);

namespace Pepperreport\Apdex;

class ApdexProcessor
{
    private $metrics;

    private $threshold;

    private $apdexTotal;

    const SATISFIED = 'satisfied';
    const TOLERATING = 'tolerating';
    const FRUSTRATED = 'frustrated';

    public function __construct(array $metrics, int $threshold = 500)
    {
        $this->metrics = $metrics;
        $this->threshold = $threshold;
    }

    public function process()
    {
        $baseApdexT = $this->threshold * 4;
        $apdexIndice = [self::SATISFIED => 0, self::TOLERATING => 0, self::FRUSTRATED => 0];
        foreach ($this->metrics as $metric) {
            if ($metric->getResponseTime() == 0) {
                ++$apdexIndice[self::FRUSTRATED];
            } elseif ($metric->getResponseTime() < $this->threshold) {
                ++$apdexIndice[self::SATISFIED];
            } elseif ($metric->getResponseTime() < $baseApdexT) {
                ++$apdexIndice[self::TOLERATING];
            } else {
                ++$apdexIndice[self::FRUSTRATED];
            }
        }

        if ($apdexIndice[self::TOLERATING] > 0 || $apdexIndice[self::FRUSTRATED] > 0) {
            $this->apdexTotal = ($apdexIndice[self::SATISFIED] + $apdexIndice[self::TOLERATING] / 2) / count($this->metrics);
        } else {
            $this->apdexTotal = 1;
        }

        return new ApdexDetail($apdexIndice, $this->apdexTotal, count($this->metrics));
    }
}
