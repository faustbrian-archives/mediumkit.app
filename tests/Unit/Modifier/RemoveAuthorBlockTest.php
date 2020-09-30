<?php

namespace Tests\Unit;

use App\Modifiers\RemoveAuthorBlockModifier;
use PHPUnit\Framework\TestCase;

class RemoveAuthorBlockTest extends TestCase
{
    public function testReplaceAuthorBlock()
    {
        $authorBlock = '<a href="/@justinrenken?source=post_page-----969b874987f9--------------------------------"><img src="https://miro.medium.com/fit/c/96/96/1*eE_ylhFv74y3-vA1upKugg.jpeg" alt="Justin Renken" /></a> <a href="/@justinrenken?source=post_page-----969b874987f9--------------------------------">Justin Renken</a><a href="https://medium.com/m/signin?actionUrl=%2F_%2Fsubscribe%2Fuser%2Fb91302deef55&amp;operation=register&amp;redirect=https%3A%2F%2Fblog.ark.io%2Fark-monthly-update-august-2020-edition-969b874987f9&amp;source=-b91302deef55-------------------------follow_byline-----------">Follow</a>   <a href="/ark-monthly-update-august-2020-edition-969b874987f9?source=post_page-----969b874987f9--------------------------------">Sep 3</a> · 16 min read  <a href="https://medium.com/m/signin?actionUrl=%2F_%2Fbookmark%2Fp%2F969b874987f9&amp;operation=register&amp;redirect=https%3A%2F%2Fblog.ark.io%2Fark-monthly-update-august-2020-edition-969b874987f9&amp;source=post_actions_header--------------------------bookmark_preview-----------"></a>';

        $content = '<h1>ARK Monthly Update — August 2020 Edition</h1>
        <p>'.$authorBlock.'   <img src="https://miro.medium.com/max/60/1*mBszd_gy9XVpAzutXqj90g.png?q=20" alt="Image for post" />';

        $expected = '<h1>ARK Monthly Update — August 2020 Edition</h1>
        <p>   <img src="https://miro.medium.com/max/60/1*mBszd_gy9XVpAzutXqj90g.png?q=20" alt="Image for post" />';

        $this->assertEquals((new RemoveAuthorBlockModifier())->modify($content, []), $expected);
    }
}
