<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\ConvertH1ToH2Modifier;

class ConvertH1ToH2ModifierTest extends TestCase
{
    public function testConvertH1ToH2()
    {
        $content = '<h1>Test Heading</h1>';

        $expected = '<h2>Test Heading</h2>';

        $this->assertEquals((new ConvertH1ToH2Modifier())->modify($content, []), $expected);
    }
}
