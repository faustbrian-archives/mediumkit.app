<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\RemoveHorizontalRuleModifier;

class RemoveHorizontalRuleTest extends TestCase
{
    public function testRemoveHorizontalRuleModifier()
    {
        $content = '<hr />'."\n".'<p>Test Paragraph</p>';

        $expected = '<p>Test Paragraph</p>';

        $this->assertEquals((new RemoveHorizontalRuleModifier())->modify($content, []), $expected);
    }
}
