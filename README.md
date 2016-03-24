# Share

Share links with Laravel 5

This is a fork to John's share for Laravel 4. 
 
## Services available

- Delicious : delicious
- Digg : digg
- Email : email
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

## Customization

Publish the package config:

    php artisan vendor:publish --provider='Chencha\Share\ShareServiceProvider'

Add a new service in config/social-share.php:

    'mynewservice' => [ 'view' => 'share.mynewservice' ]

Add Blade templating code in *share.mynewservice* view file to generate a URL for *mynewservice*. You have access to:

- service - the service definition (shown above).
- sep - separator used between parameters, defaults to '&amp;'. Configurable as *social-share.separator*.
- url - the URL being shared.
- title - the title being shared.
- media - media link being shared.

Example:

    https://mynewservice.example.com?url={{ rawurlencode($url) }}<?php echo $sep; ?>title={{ rawurlencode("Check this out! $title. See it here: $url") }}

Another example for the *email* service. Change the service config to be *[ 'view' => 'whatever' ]* and put this in the view file:

    mailto:?subject={{ rawurlencode("Wow, check this: $title") }}<?php echo $sep; ?>body={{ rawurlencode("Check this out! $title. See it here: $url") }}

Localizing? Easy, use Laravel's trans() call:

    mailto:?subject={{ rawurlencode(trans('share.email-subject', compact('url', 'title', 'media'))) }}<?php echo $sep ?>body={{ rawurlencode(trans('share.email-body', compact('url', 'title', 'media'))) }}

Create a file at resources/lang/en/share.php with your choice of subject and body. URLs arguably have a maximum length of 2000 characters.

Notice the use of *<?php echo $sep; ?>*. It's the only way to print out an unencoded ampersand (if configured that way).
