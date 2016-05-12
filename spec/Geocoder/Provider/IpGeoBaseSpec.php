<?php

namespace spec\Geocoder\Provider;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IpGeoBaseSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Geocoder\Provider\IpGeoBase');
    }
}
