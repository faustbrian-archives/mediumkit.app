<?php

namespace Tests\Unit;

use App\Modifiers\RemoveHorizontalRuleModifier;
use PHPUnit\Framework\TestCase;

class RemoveHorizontalRuleModifierTest extends TestCase
{
    public function testRemoveHorizontalRuleModifier()
    {
        $content = '<hr />'."\n".'<hr /><p>Test Paragraph</p>'."\n";

        $expected = '<p>Test Paragraph</p>'."\n";

        $this->assertEquals((new RemoveHorizontalRuleModifier())->modify($content, []), $expected);
    }
}
