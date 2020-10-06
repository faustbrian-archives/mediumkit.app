<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\RemoveHorizontalRuleModifier;

class RemoveHorizontalRuleTest extends TestCase
{
    public function testRemoveHorizontalRuleModifier()
    {
        $content = '<hr />'."\n".'<hr /><p>Test Paragraph</p>'."\n";

        $expected = '<p>Test Paragraph</p>'."\n";

        $this->assertEquals((new RemoveHorizontalRuleModifier())->modify($content, []), $expected);
    }
}
