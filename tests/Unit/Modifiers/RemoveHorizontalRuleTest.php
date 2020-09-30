<?php

namespace Tests\Unit;

use App\Modifiers\RemoveHorizontalRuleModifier;
use PHPUnit\Framework\TestCase;

class RemoveHorizontalRuleModifierTest extends TestCase
{
    public function testRemoveHorizontalRuleModifier()
    {
        $content = '<hr />'."\n".'<p>Test Paragraph</p>';

        $expected = '<p>Test Paragraph</p>';

        $this->assertEquals((new RemoveHorizontalRuleModifier())->modify($content, []), $expected);
    }
}
