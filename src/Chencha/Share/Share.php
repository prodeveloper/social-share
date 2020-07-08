<?php namespace Chencha\Share;

use Chencha\Share\Exceptions\NoServiceIsAvailable;
use Chencha\Share\Exceptions\ServiceNotSupportedException;
use View;

class Share
{
    protected $app;

    protected $url;
    protected $title;
    protected $media;

    public function __construct($app)
    {
        $this->app = $app;
    }

    public function load($url, $title = '', $media = '')
    {
        $this->url = $url;
        $this->title = $title;
        $this->media = $media;
        return $this;
    }

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
     * @throws ServiceNotSupportedException
     * @throws NoServiceIsAvailable
     */
    protected function generateUrl($serviceId)
    {
        $services = $this->getServices();

        if (empty($services))
            throw new NoServiceIsAvailable();

        $servicesKeys = array_keys($services);

        if (!in_array($serviceId,$servicesKeys))
            throw new ServiceNotSupportedException($serviceId, $servicesKeys);

        $vars = [
            'service' => $services[$serviceId],
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

        $view = \Arr::get($vars['service'], 'view', 'social-share::default');

        return trim(View::make($view, $vars)->render());
    }

    public function __call($name, $arguments)
    {
        return $this->generateUrl($name);
    }

    /**
     * get list of all supported services
     *
     * @return array
     */
    protected function getServices()
    {
        return $this->app->config->get("social-share.services", []);
    }
}
