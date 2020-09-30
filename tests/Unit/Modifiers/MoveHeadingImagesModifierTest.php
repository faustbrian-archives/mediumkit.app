<?php

namespace Tests\Unit;

use App\Modifiers\MoveHeadingImagesModifier;
use PHPUnit\Framework\TestCase;

class MoveHeadingImagesModifierTest extends TestCase
{
    public function testMoveHeadingImages()
    {
        $content = '<h1>   <img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" /> <img src="" alt="Image for post" /><img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" /> Test Heading</h1>';

        $expected = '<img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" />'."\n".
            '<img src="" alt="Image for post" />'."\n".
            '<img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" />'."\n".
            '<h1> Test Heading</h1>';

        $this->assertEquals((new MoveHeadingImagesModifier())->modify($content, []), $expected);
    }
}
