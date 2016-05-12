<?php

/**
 * @author Mikhail A. Sivolobov <astronomer@gmail.com>
 *
 * @license    MIT License
 */

namespace Geocoder\Provider;
use Geocoder\Exception\UnsupportedOperation;
use Geocoder\Model\AddressCollection;


/**
 * Class that provides IpGeoBase service as Geocoder Provider
 */
class IpGeoBase implements Provider
{
    /**
     * @inheritDoc
     */
    public function geocode($address)
    {
        if (!filter_var($address, FILTER_VALIDATE_IP)) {
            throw new UnsupportedOperation('The FreeGeoIp provider does not support street addresses.');
        }

        return new AddressCollection();
    }

    /**
     * @inheritDoc
     */
    public function reverse($latitude, $longitude)
    {
        // TODO: Implement reverse() method.
    }

    /**
     * @inheritDoc
     */
    public function getLimit()
    {
        // TODO: Implement getLimit() method.
    }

    /**
     * @inheritDoc
     */
    public function limit($limit)
    {
        // TODO: Implement limit() method.
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        // TODO: Implement getName() method.
    }

}
