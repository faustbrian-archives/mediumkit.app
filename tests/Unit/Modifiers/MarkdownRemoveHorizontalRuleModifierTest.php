<?php

namespace Tests\Unit;

use App\Modifiers\MarkdownRemoveHorizontalRuleModifier;
use PHPUnit\Framework\TestCase;

class MarkdownRemoveHorizontalRuleModifierTest extends TestCase
{
    public function testRemoveHorizontalRule()
    {
        $content = "\n".'- - - - - -'."\n".'- - - - - -**After months of hard work**';

        $expected = "\n\n".'**After months of hard work**';

        $this->assertEquals((new MarkdownRemoveHorizontalRuleModifier())->modify($content, []), $expected);
    }
}
