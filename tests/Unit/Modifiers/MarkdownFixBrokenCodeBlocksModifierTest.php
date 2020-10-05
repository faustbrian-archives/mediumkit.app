<?php

namespace Tests\Unit;

use App\Modifiers\MarkdownFixBrokenCodeBlocksModifier;
use PHPUnit\Framework\TestCase;

class MarkdownFixBrokenCodeBlocksModifierTest extends TestCase
{
    public function testRule()
    {
        $content = '
```
```javascript
const twilio;
const util;
```
```
```
```
const test;
```
```

```
```
const test;
```
```
';

        $expected = '
```javascript
const twilio;
const util;
```
```
const test;
```

```
const test;
```
';

        $this->assertEquals($expected, (new MarkdownFixBrokenCodeBlocksModifier())->modify($content, []));
    }
}
