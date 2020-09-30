<?php

namespace Tests\Unit;

use App\Modifiers\RemoveTopTweetModifier;
use PHPUnit\Framework\TestCase;

class RemoveTopTweetModifierTest extends TestCase
{
    public function testRemoveTopTweet()
    {
        $content = '<h1>TOP TWEET</h1>\n<p><a href="https://twitter.com/ArkEcosystem/status/1295759668166438912">This Month’s Top Tweet (Link for Retweet)</a>- - - - - -</p>'."\n".'<p>Test Content</p>';

        $expected = '<p>Test Content</p>';

        $this->assertEquals((new RemoveTopTweetModifier())->modify($content, []), $expected);
    }
}
