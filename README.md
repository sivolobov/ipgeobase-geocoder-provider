Geocoder IpGeoBase provider
==============

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/9ea6d698-549e-4cbf-bd02-acb1938844bb/big.png)](https://insight.sensiolabs.com/projects/9ea6d698-549e-4cbf-bd02-acb1938844bb)

This repository hosts IpGeoBase provider to use with Geocoder library.

Installation
------------
The recommended way to install this package is through Composer:

    composer require sivolobov/geocoder-ipgeobase

Usage
-----
You need to read [Geocoder's usage documentaion][1] first.

Simple example:

    $curl     = new \Ivory\HttpAdapter\CurlHttpAdapter();
    $geocoder = new \Geocoder\Provider\IpGeoBase($curl);

    $addressCollection = $geocoder->geocode('213.180.193.3');

Symfony integration
-------------------
To use IpGeoBase in Symfony project you need to install [BazingaGeocoderBundle][2]:

After configuring bundle you need to define custom provider. So add these lines to your `services.yml`:

    bazinga_geocoder.provider.ip_geo_base:
        class:  Geocoder\Provider\IpGeoBase
        arguments:
            - "@bazinga_geocoder.geocoder.adapter"
        tags:
            - {name: "bazinga_geocoder.provider"}
        public: false
        lazy:   true

Now you can use it as:

    $addressCollection = $this->get('geocoder')->using('ip_geo_base')->geocode($request->getClientIp());

Notes
-----
Note that `geocode()` return `AddressCollection` instance but IpGeoBase always return only one address for one IP.
So that collection will always have only one element.

License
-------

Geocoder IpGeoBase provider is released under the MIT License. See the bundled LICENSE file
for details.

[1]: https://github.com/geocoder-php/Geocoder#usage
[2]: https://github.com/geocoder-php/BazingaGeocoderBundle/blob/master/Resources/doc/index.md
