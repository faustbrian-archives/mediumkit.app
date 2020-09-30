<?php

namespace Tests\Unit;

use App\Modifiers\ConvertH2ToH3Modifier;
use PHPUnit\Framework\TestCase;

class ConvertH2ToH3ModifierTest extends TestCase
{
    public function testConvertH2ToH3()
    {
        $content = '<h2>Test Heading</h2>';

        $expected = '<h3>Test Heading</h3>';

        $this->assertEquals((new ConvertH2ToH3Modifier())->modify($content, []), $expected);
    }
}
