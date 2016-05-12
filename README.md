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

    $geocoder->geocode('213.180.193.3');

License
-------

Geocoder IpGeoBase provider is released under the MIT License. See the bundled LICENSE file
for details.

[1]: https://github.com/geocoder-php/Geocoder#usage
