[Apdex](https://en.wikipedia.org/wiki/Apdex) (*Application Performance Index*) allow us to monitor end users satisfaction. 
It is an open industry standard that estimate the user's satisfaction level on an application's response time through a score between 0 and 1.

The Apdex score is calculated based on your required SLA (*Service-Level Agreement*) where you can define a response time threshold of T seconds, where all responses handled in T or less seconds satisfy the end user.

Apdex provides three thresholds estimating end user satisfaction, **satisfied**, **tolerating** and **frustrating**.

- **Satisfied:** Response time less than or equal to T seconds.
- **Tolerating:** Response time between T seconds and 4T seconds.
- **Frustrating:** Response time greater than 4 T seconds.

###How to calculate your Apdex :
```php
$apdexProcessor = new ApdexProcessor($metrics, $threshold);
$apdexDetail = $apdexProcessor->process();

// get your Apdex score
$apdexDetail->getApdex();
    
```
