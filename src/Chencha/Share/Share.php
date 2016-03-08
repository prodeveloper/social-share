<?php namespace Chencha\Share;

use View;

class Share {
    protected $app;

	protected $url;
	protected $title;
	protected $media;

    public function __construct($app){
        $this->app = $app;
    }

	public function load($url, $title = '', $media = ''){
		$this->url = $url;
		$this->title = $title;
		$this->media = $media;
		return $this;
	}

	public function services(){
		$services = func_get_args();

        if (empty($services)) {
            $services = array_keys($this->app->config->get('social-share.services'));
        }

		$object = false;
		if (end($services) === true)
		{
			$object = true;
			array_pop($services);
		}

		$return = array();

		if ($services){
			foreach ($services as $service){
                $return[$service] = $this->$service();
			}
		}

		if ($object)
		{
			return (object) $return;
		}

		return $return;
	}

    protected function generateUrl($serviceId) {
        $vars = [
            'service' => $this->app->config->get("social-share.services.$serviceId", []),
            'sep' => $this->app->config->get('social-share.separator', '&'),
        ];

        if (empty($vars['service']['only'])) {
            $only = [ 'url', 'title', 'media' ];
        } else {
            $only = $vars['service']['only'];
        }

        foreach ($only as $varName) {
            $vars[$varName] = $this->$varName;
        }

        $view = array_get($vars['service'], 'view', 'social-share::default');
        return trim(View::make($view, $vars)->render());
    }

    public function __call($name, $arguments)
    {
        return $this->generateUrl($name);
    }
}
