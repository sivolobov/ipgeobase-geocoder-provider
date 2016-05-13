<?php

/**
 * @author Mikhail A. Sivolobov <astronomer@gmail.com>
 *
 * @license    MIT License
 */

namespace Geocoder\Provider;

use Geocoder\Exception\UnexpectedValue;
use Geocoder\Exception\UnsupportedOperation;
use Geocoder\Exceptions\ImmutableChanged;


/**
 * Class that provides IpGeoBase service as Geocoder Provider
 */
class IpGeoBase extends AbstractHttpProvider implements Provider
{
    const ENDPOINT_URL = 'http://ipgeobase.ru:7020/geo?ip=%s';

    /**
     * @inheritDoc
     */
    public function geocode($address)
    {
        if (!filter_var($address, FILTER_VALIDATE_IP)) {
            throw new UnsupportedOperation('The IpGeoBaseSpec provider does not support street addresses.');
        }

        if (in_array($address, array('127.0.0.1', '::1'))) {
            return $this->returnResults([$this->getLocalhostDefaults()]);
        }

        $body = $this->getAdapter()->get(sprintf(self::ENDPOINT_URL, $address))->getBody();

        try {
            $xml = new \SimpleXmlElement($body);
        } catch (\Exception $e) {
            throw new UnexpectedValue('Can\'t parse the result');
        }

        $result = $xml->ip;

        return $this->returnResults(
            [
                array_merge(
                    $this->getDefaults(),
                    [
                        'latitude' => (double)$result->lat,
                        'longitude' => (double)$result->lng,
                        'locality' => (string)$result->city,
                        'countryCode' => (string)$result->country,
                    ]
                )
            ]
        );
    }

    /**
     * @inheritDoc
     */
    public function reverse($latitude, $longitude)
    {
        throw new UnsupportedOperation('The IpGeoBaseSpec provider is not able to do reverse geocoding.');
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return 'ip_geo_base';
    }

}
