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

    function it_should_implement_geocoder_provider_interface()
    {
        $this->shouldImplement('Geocoder\Provider\Provider');
    }
    
    function it_retrieves_address_collection_by_ip()
    {
        $this->geocode('91.221.60.82')->shouldHaveType('Geocoder\Model\AddressCollection');
    }
    
    function it_throws_an_exception_while_trying_to_pass_not_an_ip()
    {
        $this->shouldThrow('Geocoder\Exception\UnsupportedOperation')->during('geocode', [null]);
        $this->shouldThrow('Geocoder\Exception\UnsupportedOperation')->during('geocode', ['test']);
        $this->shouldThrow('Geocoder\Exception\UnsupportedOperation')->during('geocode', ['256.255.255.255']);
        $this->shouldThrow('Geocoder\Exception\UnsupportedOperation')->during('geocode', ['1.1.1.256']);
    }
}
