<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\RemoveListItemParagraphsModifier;

class RemoveListItemParagraphsModifierTest extends TestCase
{
    public function testRemoveListItemParagraphs()
    {
        $content = '<li><p>item 1</p></li>'."\n".
            '<li><p>item 2</p></li>'."\n".
            '<li><p>item 3</p></li>'."\n".
            '<li><p>item 4</p></li>'."\n";

        $expected = '<li>item 1</li>'."\n".
            '<li>item 2</li>'."\n".
            '<li>item 3</li>'."\n".
            '<li>item 4</li>'."\n";

        $this->assertEquals((new RemoveListItemParagraphsModifier())->modify($content, []), $expected);
    }
}
