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

    function it_throws_an_exception_while_trying_to_get_address_collection_by_coordinates()
    {
        $this->shouldThrow('Geocoder\Exception\UnsupportedOperation')->during('reverse', [56.5, 82.5]);
    }

    function it_returns_one_on_requesting_maximum_amount_that_can_be_returned_in_address_collection()
    {
        $this->getLimit()->shouldReturn(1);
    }
}
