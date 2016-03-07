<?php namespace Chencha\Share;

class Share {
	protected $link;
	protected $text;
	protected $media;

	public function load($link, $text = '', $media = ''){
		$this->link = urlencode($link);
		$this->text = urlencode($text);
		$this->media = urlencode($media);

		return $this;
	}

	public function services(){
		$services = func_get_args();

		$object = false;
		if (end($services) === true)
		{
			$object = true;
			array_pop($services);
		}

		$return = array();

		if ($services){
			foreach ($services as $service){
				if (method_exists('Chencha\Share\Share', $service)){
					$return[$service] = $this->$service();
				}
			}
		}

		if ($object)
		{
			return (object) $return;
		}

		return $return;
	}

	public function delicious(){
		return 'https://delicious.com/post?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function digg(){
		return 'http://www.digg.com/submit?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function evernote(){
		return 'http://www.evernote.com/clip.action?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function facebook(){
		return 'https://www.facebook.com/sharer/sharer.php?u='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function gmail(){
		return 'https://mail.google.com/mail/?view=cm&fs=1&to&ui=2&tf=1&su='.$this->link.(($this->text) ? '&body='.$this->text : '');
	}

	public function gplus(){
		return 'https://plus.google.com/share?url='.$this->link;
	}

	public function linkedin(){
		return 'http://www.linkedin.com/shareArticle?mini=true&url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function pinterest(){
		return 'http://pinterest.com/pin/create/button/?url='.$this->link.(($this->media) ? '&media='.$this->media : '').(($this->text) ? '&description='.$this->text : '');
	}

	public function reddit(){
		return 'http://www.reddit.com/submit?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function scoopit(){
		return 'http://www.scoop.it/oexchange/share?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}

	public function springpad(){
		return 'https://springpadit.com/s?type=lifemanagr.Bookmark&url='.$this->link.(($this->text) ? '&name='.$this->text : '');
	}

	public function tumblr(){
		return 'http://www.tumblr.com/share?v=3&u='.$this->link.(($this->text) ? '&t='.$this->text : '');
	}

	public function twitter(){
		return 'https://twitter.com/intent/tweet?url='.$this->link.(($this->text) ? '&text='.$this->text : '');
	}

	public function viadeo(){
		return 'http://www.viadeo.com/?url='.$this->link.(($this->text) ? '&title='.$this->text : '');
	}
	
	public function vk(){
		return 'http://vk.com/share.php?url='.$this->link.(($this->media) ? '&image='.$this->media : '').(($this->text) ? '&title='.$this->text : '').'&noparse=false';
	}
	
	public function whatsapp(){
		return 'whatsapp://send?text='.(($this->text) ? $this->text.'%20' : '').$this->link;
	}
}
