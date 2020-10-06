<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\MoveParagraphImagesModifier;

class MoveParagraphImagesModifierTest extends TestCase
{
    public function testMoveParagraphImages()
    {
        $content = '<p>   <img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" /> <img src="" alt="Image for post" /><img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" /> Test Paragraph</p>';

        $expected = '<img src="https://miro.medium.com/max/60/1*nbf2fsBry9lmBVtNmAtkKg.png?q=20" alt="Image for post" />'."\n".
            '<img src="" alt="Image for post" />'."\n".
            '<img src="https://miro.medium.com/max/2450/1*nbf2fsBry9lmBVtNmAtkKg.png" alt="Image for post" />'."\n".
            '<p> Test Paragraph</p>';

        $this->assertEquals((new MoveParagraphImagesModifier())->modify($content, []), $expected);
    }
}
