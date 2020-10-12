<?php

namespace Tests\Unit;

use App\Modifiers\MarkdownRemoveHeadingImagesModifier;
use PHPUnit\Framework\TestCase;

class MarkdownRemoveHeadingImagesModifierTest extends TestCase
{
    public function testRemoveHeadingImages()
    {
        $content = "\n".'![](https://miro.medium.com/max/1280/1*4RvmBk8b57xrMuGi9L8W7g.png?q=20)![](https://miro.medium.com/max/2450/1*4RvmBk8b57xrMuGi9L8W7g.png)**After months of hard work**';

        $expected = '**After months of hard work**';

        $this->assertEquals((new MarkdownRemoveHeadingImagesModifier())->modify($content, []), $expected);
    }
}
