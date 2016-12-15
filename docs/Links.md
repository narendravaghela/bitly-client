# API methods related to Links
As of now, there are following API methods available.
## expand
Returns the target (long) URL. See http://dev.bitly.com/links.html#v3_expand
```php
$bitlyClient = new BitlyClient('your-access-token');

$options = ['shortUrl' => 'http://bit.ly/1RmnUT'];
$jsonResp = $bitlyClient->expand($options);
```
## info
Returns the basic detials like title, short url, hash etc. for a given Bitlink. See http://dev.bitly.com/links.html#v3_info
```php
$bitlyClient = new BitlyClient('your-access-token');

$options = ['shortUrl' => 'http://bit.ly/1RmnUT'];
$jsonResp = $bitlyClient->info($options);
```
## shorten
Returns a Bitlink (short url) for a given link. See http://dev.bitly.com/links.html#v3_shorten
```php
$bitlyClient = new BitlyClient('your-access-token');

$options = ['longUrl' => 'http://bit.ly/1RmnUT'];
$jsonResp = $bitlyClient->shorten($options);
```
You can also pass your custom domain name like,
```php
$options = [
    'longUrl' => 'http://bit.ly/1RmnUT',
    'domain' => 'bit.ly'
];
```
