<?php

use Illuminate\View\Factory as ViewFactory;
use GuzzleHttp\Client;

class ShareTest extends TestCase
{
    protected $expected = [
        "delicious" => "https://delicious.com/post?url=http%3A%2F%2Fwww.example.com&title=Example",
        "digg" => "http://www.digg.com/submit?url=http%3A%2F%2Fwww.example.com&title=Example",
        "email" => "mailto:?subject=Example&body=http%3A%2F%2Fwww.example.com",
        "evernote" => "http://www.evernote.com/clip.action?url=http%3A%2F%2Fwww.example.com&title=Example",
        "facebook" => "https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.example.com&title=Example",
        "gmail" => "https://mail.google.com/mail/?su=http%3A%2F%2Fwww.example.com&body=Example&view=cm&fs=1&to=&ui=2&tf=1",
        "gplus" => "https://plus.google.com/share?url=http%3A%2F%2Fwww.example.com",
        "linkedin" => "http://www.linkedin.com/shareArticle?url=http%3A%2F%2Fwww.example.com&title=Example&mini=true",
        "pinterest" => "http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.example.com&description=Example&media=Media",
        "reddit" => "http://www.reddit.com/submit?url=http%3A%2F%2Fwww.example.com&title=Example",
        "scoopit" => "http://www.scoop.it/oexchange/share?url=http%3A%2F%2Fwww.example.com&title=Example",
        "tumblr" => "http://www.tumblr.com/share?u=http%3A%2F%2Fwww.example.com&t=Example&v=3",
        "twitter" => "https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.example.com&text=Example",
        "viadeo" => "http://www.viadeo.com/?url=http%3A%2F%2Fwww.example.com&title=Example",
        "vk" => "http://vk.com/share.php?url=http%3A%2F%2Fwww.example.com&title=Example&image=Media&noparse=false",
        "whatsapp" => "whatsapp://send?text=Example%20http%3A%2F%2Fwww.example.com",
        "whatsapp" => "whatsapp://send?text=Example%20http%3A%2F%2Fwww.example.com",

        "service" => "http://service.example.com?url=http%3A%2F%2Fwww.example.com&title=Example&media=Media",
        "service2" => "http://service2.example.com?url=http%3A%2F%2Fwww.example.com&title=Example&extra1=Extra%201&extra2=Extra%202",
    ];

    protected function getPackageProviders($app)
    {
        return [
            'Chencha\Share\ShareServiceProvider',
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Share' => 'Chencha\Share\ShareFacade',
        ];
    }

    protected function getEnvironmentSetup($app)
    {
        $app->config->set('social-share.services.service', [
            'uri' => 'http://service.example.com',
            'mediaName' => 'media',
        ]);

        $app->config->set('social-share.services.service2', [
            'uri' => 'http://service2.example.com',
            'extra' => [ 'extra1' => 'Extra 1', 'extra2' => 'Extra 2' ]
        ]);
    }

    public function testCallMethod()
    {
        $view = View::make('social-share::mock');

        View::shouldReceive('make')
            ->with('social-share::default', [
                'service' => [ 'uri' => 'http://service2.example.com', 'extra' => [
                    'extra1' => 'Extra 1',
                    'extra2' => 'Extra 2',
                ]],
                'url' => 'http://www.example.com',
                'title' => '',
                'media' => '',
                'sep' => '&'
            ])
            ->andReturn($view);

        Share::load('http://www.example.com')->service2();
    }

    public function testViewMake()
    {
        $view = View::make('social-share::mock');

        View::shouldReceive('make')
            ->with('social-share::default', [
                'service' => [ 'uri' => 'http://service.example.com', 'mediaName' => 'media' ],
                'url' => 'http://www.example.com',
                'title' => '',
                'media' => '',
                'sep' => '&'
            ])
            ->andReturn($view);

        Share::load('http://www.example.com')->service();
    }

    public function testRenderUrlOnly()
    {
        $this->assertEquals('http://service.example.com?url=http%3A%2F%2Fwww.example.com',
                            Share::load('http://www.example.com')->service());
    }

    public function testRenderUrlAndTitle()
    {
        $this->assertEquals('http://service.example.com?url=http%3A%2F%2Fwww.example.com&title=Example',
                            Share::load('http://www.example.com', 'Example')->service());
    }

    public function testRenderUrlTitleAndMedia()
    {
        $this->assertEquals('http://service.example.com?url=http%3A%2F%2Fwww.example.com&title=Example&media=Media',
                            Share::load('http://www.example.com', 'Example', 'Media')->service());
    }

    public function testRenderExtra()
    {
        $this->assertEquals('http://service2.example.com?url=http%3A%2F%2Fwww.example.com&extra1=Extra%201&extra2=Extra%202',
                            Share::load('http://www.example.com')->service2());
    }

    public function testSeparator()
    {
        $this->app->config->set('social-share.separator', '&amp;');
        $this->assertEquals('http://service.example.com?url=http%3A%2F%2Fwww.example.com&amp;title=Example',
                            Share::load('http://www.example.com', 'Example')->service());
    }

    public function testServices()
    {
        $actual = Share::load('http://www.example.com', 'Example', 'Media')->services(
            'delicious',
            'digg',
            'email',
            'evernote',
            'facebook',
            'gmail',
            'gplus',
            'linkedin',
            'pinterest',
            'reddit',
            'scoopit',
            'tumblr',
            'twitter',
            'viadeo',
            'vk',
            'whatsapp',

            'service',
            'service2'
        );

        $this->assertEquals($this->expected, $actual);
    }

    public function testDefaultIsAll()
    {
        $actual = Share::load('http://www.example.com', 'Example', 'Media')->services();
        $this->assertEquals($this->expected, $actual);
    }

    protected function assertPageFound($url)
    {
        $client = new Client([
            'http_errors' => false,
        ]);

        $response = $client->head($url);
        $this->assertEquals(200,  $response->getStatusCode());
    }

    /**
     * @group live
     */
    public function testDelicious()
    {
        $url = 'https://delicious.com/post?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->delicious());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testDigg()
    {
        $url = 'http://www.digg.com/submit?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->digg());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testEmail()
    {
        $url = 'mailto:?subject=Example&body=http%3A%2F%2Fwww.example.com';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->email());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testEvernote()
    {
        $url = 'http://www.evernote.com/clip.action?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->evernote());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testFacebook()
    {
        $url = 'https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->facebook());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testGmail()
    {
        $url = 'https://mail.google.com/mail/?su=http%3A%2F%2Fwww.example.com&body=Example&view=cm&fs=1&to=&ui=2&tf=1';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->gmail());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testGplus()
    {
        $url = 'https://plus.google.com/share?url=http%3A%2F%2Fwww.example.com';
        $this->assertEquals($url, Share::load('http://www.example.com')->gplus());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testLinkedin()
    {
        $url = 'http://www.linkedin.com/shareArticle?url=http%3A%2F%2Fwww.example.com&title=Example&mini=true';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->linkedin());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testPinterest()
    {
        $url = 'http://pinterest.com/pin/create/button/?url=http%3A%2F%2Fwww.example.com&description=Example&media=Media';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example', 'Media')->pinterest());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testReddit()
    {
        $url = 'http://www.reddit.com/submit?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->reddit());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testScoopit()
    {
        $url = 'http://www.scoop.it/oexchange/share?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->scoopit());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testTumblr()
    {
        $url = 'http://www.tumblr.com/share?u=http%3A%2F%2Fwww.example.com&t=Example&v=3';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->tumblr());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testTwitter()
    {
        $url = 'https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.example.com&text=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->twitter());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testViadeo()
    {
        $url = 'http://www.viadeo.com/?url=http%3A%2F%2Fwww.example.com&title=Example';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->viadeo());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testVk()
    {
        $url = 'http://vk.com/share.php?url=http%3A%2F%2Fwww.example.com&title=Example&image=Media&noparse=false';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example', 'Media')->vk());
        // $this->assertPageFound($url);
    }

    /**
     * @group live
     */
    public function testWhatsapp()
    {
        $url = 'whatsapp://send?text=Example%20http%3A%2F%2Fwww.example.com';
        $this->assertEquals($url, Share::load('http://www.example.com', 'Example')->whatsapp());
        // $this->assertPageFound($url);
    }
}
