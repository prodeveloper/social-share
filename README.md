# Share

Share links with Laravel 5

This is a fork to John's share for Laravel 4. 
 
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
- Tumblr : tumblr
- Twitter : twitter
- Viadeo : viadeo
- vk.com : vk


## Installation

Step 1 : Install Composer dependency

    composer require chencha/share

Step 2 : Register the Service Provider

Add *Chencha\Share\ShareServiceProvider* to providers array in *config/app.php*

Step 3 : Register Alias


Add *Share* => *Chencha\Share\ShareFacade* to aliases array in *config/app.php*


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

    {
        "gplus" : "https://plus.google.com/share?url=http%3A%2F%2Fwww.example.com",
        "twitter" : "https://twitter.com/intent/tweet?url=http%3A%2F%2Fwww.example.com&text=Link+description",
        "facebook" : "https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.example.com&title=Link+description"
    }


Get ALL the links

	Route::get('/', function()
	{
		return Share::load('http://www.example.com', 'Link description')->services();
	});

Returns an array of results for all defined services.
