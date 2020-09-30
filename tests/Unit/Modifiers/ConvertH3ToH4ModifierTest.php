<?php

namespace Tests\Unit;

use App\Modifiers\ConvertH3ToH4Modifier;
use PHPUnit\Framework\TestCase;

class ConvertH3ToH4ModifierTest extends TestCase
{
    public function testConvertH3ToH4()
    {
        $content = '<h3>Test Heading</h3>';

        $expected = '<h4>Test Heading</h4>';

        $this->assertEquals((new ConvertH3ToH4Modifier())->modify($content, []), $expected);
    }
}
