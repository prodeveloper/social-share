# Share

Share links with Laravel 5

This is a fork to John's share for Laravel 4
 


## Installation

Run

    composer require chencha/share
    

Now open up `app/config/app.php` and add the service provider to your `providers` array.

    'providers' => array(
        'Thujohn\Share\ShareServiceProvider',
    )

Now add the alias.

    'aliases' => array(
        'Share' => 'Thujohn\Share\ShareFacade',
    )


## Usage

Get a link (example with Twitter)

	Route::get('/', function()
	{
		return Share::load('http://www.example.com', 'My example')->twitter();
	});

Returns a string :

	https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.example.com&text=Link+description


Get many links

	Route::get('/', function()
	{
		return Share::load('http://www.example.com', 'Link description')->services('facebook', 'gplus', 'twitter');
	});

Returns an array :

	{"facebook":"https:\/\/www.facebook.com\/sharer\/sharer.php?u=http%3A%2F%2Fwww.example.com&title=Link+description","gplus":"https:\/\/plus.google.com\/share?url=http%3A%2F%2Fwww.example.com","twitter":"https:\/\/twitter.com\/intent\/tweet?url=http%3A%2F%2Fwww.example.com&text=Link+description"}


## Services available
- Delicious : delicious
- Digg : digg
- Evernote : evernote
- Facebook : facebook
- Gmail : gmail
- Google Plus : gplus
- LinkedIn : linkedin
- Pinterest : pinterest
- Reddit : reddit
- Scoop.it : scoopit
- Springpad : springpad
- Tumblr : tumblr
- Twitter : twitter
- Viadeo : viadeo
- vk.com : vk
