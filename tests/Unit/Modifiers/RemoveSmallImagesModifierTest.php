<?php

namespace Tests\Unit;

use App\Modifiers\RemoveSmallOrMissingImagesModifier;
use PHPUnit\Framework\TestCase;

class RemoveSmallOrMissingImagesModifierTest extends TestCase
{
    public function testRemoveSmallImages()
    {
        $content = '<p>   <img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" /> <img src="" alt="Image for post" /><img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" /> Test Heading</p>';

        $expected = '<p>    <img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" /> Test Heading</p>';

        $this->assertEquals((new RemoveSmallOrMissingImagesModifier())->modify($content, []), $expected);
    }
}
