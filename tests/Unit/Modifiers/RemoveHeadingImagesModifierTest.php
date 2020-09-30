<?php

namespace Tests\Unit;

use App\Modifiers\RemoveHeadingImagesModifier;
use PHPUnit\Framework\TestCase;

class RemoveHeadingImagesModifierTest extends TestCase
{
    public function testRemoveHeadingImages()
    {
        $content = '  <img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" /> <p>Test Content</p>';

        $expected = ' <p>Test Content</p>';

        $this->assertEquals((new RemoveHeadingImagesModifier())->modify($content, []), $expected);
    }
}
