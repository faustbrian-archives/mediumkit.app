<?php

namespace Tests\Unit;

use App\Modifiers\RemoveTopHeadingModifier;
use PHPUnit\Framework\TestCase;

class RemoveTopHeadingModifierTest extends TestCase
{
    public function testReplaceTitle()
    {
        $title = 'Test Article Title';
        $content = '<h1>'.$title.'</h1><p>Description</p>';

        $this->assertEquals((new RemoveTopHeadingModifier())->modify($content, compact('title')), '<p>Description</p>');
    }
}
