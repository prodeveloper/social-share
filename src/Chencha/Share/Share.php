<?php namespace Chencha\Share;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

/**
 * Class Share
 * @method string delicious()
 * @method string digg()
 * @method string email()
 * @method string evernote()
 * @method string facebook()
 * @method string gmail()
 * @method string gplus()
 * @method string linkedin()
 * @method string pinterest()
 * @method string reddit()
 * @method string scoopit()
 * @method string telegramMe()
 * @method string tumblr()
 * @method string twitter()
 * @method string viadeo()
 * @method string vk()
 * @package Chencha\Share\Facades
 */
class Share
{
    /**
     * The application instance
     */
    protected $app;

    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var string $title
     */
    protected $title;

    /**
     * @var string $media
     */
    protected $media;

    /**
     * Share constructor.
     * @param $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $url
     * @param string $title
     * @param string $media
     * @return $this
     */
    public function load($url, $title = '', $media = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->media = $media;
        return $this;
    }

    /**
     * @return array|object
     */
    public function services()
    {
        $services = func_get_args();

        if (empty($services)) {
            $services = array_keys($this->app->config->get('social-share.services'));
        } elseif (is_array($services[0])) {
            $services = $services[0];
        }

        $object = false;
        if (end($services) === true) {
            $object = true;
            array_pop($services);
        }

        $return = array();

        if ($services) {
            foreach ($services as $service) {
                $return[$service] = $this->$service();
            }
        }

        if ($object) {
            return (object)$return;
        }

        return $return;
    }

    /**
     * @param string $serviceId
     * @return string
     */
    protected function generateUrl($serviceId)
    {
        $vars = [
            'service' => $this->app->config->get("social-share.services.$serviceId", []),
            'sep' => $this->app->config->get('social-share.separator', '&'),
        ];

        if (empty($vars['service']['only'])) {
            $only = ['url', 'title', 'media'];
        } else {
            $only = $vars['service']['only'];
        }

        foreach ($only as $varName) {
            $vars[$varName] = $this->$varName;
        }

        $view = Arr::get($vars['service'], 'view', 'social-share::default');

        return trim(View::make($view, $vars)->render());
    }

    /**
     * @param string $name
     * @param $arguments
     * @return string
     */
    public function __call($name, $arguments)
    {
        return $this->generateUrl($name);
    }
}
