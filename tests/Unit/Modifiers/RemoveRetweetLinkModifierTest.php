<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Modifiers\RemoveRetweetLinkModifier;

class RemoveRetweetLinkModifierTest extends TestCase
{
    public function testRemoveTopTweet()
    {
        $content = '<h1>TOP TWEET</h1>'."\n".
            '<p><a href="https://twitter.com/ArkEcosystem/status/1295759668166438912">This Month’s Top Tweet (Link for Retweet)</a>- - - - - -</p>'."\n".
            '<p>Test Content</p>'."\n".
            '<h1>TOP TWEET</h1>'."\n";

        $expected = '<h1>TOP TWEET</h1>'."\n".
            '<p>Test Content</p>'."\n".
            '<h1>TOP TWEET</h1>'."\n";

        $this->assertEquals((new RemoveRetweetLinkModifier())->modify($content, []), $expected);
    }
}
