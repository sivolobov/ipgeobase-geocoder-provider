<?php

namespace spec\Geocoder\Provider;

use Ivory\HttpAdapter\CurlHttpAdapter;
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

    function it_should_be_instance_of_abstract_http_provider()
    {
        $this->shouldHaveType('Geocoder\Provider\AbstractHttpProvider');
    }
    
    function let()
    {
        $this->beConstructedWith(new CurlHttpAdapter());
    }

    /**
     * @dataProvider ipToCityExamples
     */
    function it_retrieves_address_collection_by_ip($ip)
    {
        $this->geocode($ip)->shouldHaveType('Geocoder\Model\AddressCollection');
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

    /**
     * @dataProvider ipToCityExamples
     */
    function it_returns_only_one_address_in_collection($ip)
    {
        $this->geocode($ip)->count()->shouldReturn(1);
    }

    function it_returns_name_ip_geo_base_with_underscores()
    {
        $this->getName()->shouldReturn('ip_geo_base');
    }

    /**
     * @dataProvider ipToCityExamples
     */
    function it_returns_proper_city_names_for_russian_ips($ip, $city)
    {
        $this->geocode($ip)->first()->getLocality()->shouldReturn($city);
    }

    function it_returns_defaults_while_passing_localhost_ip()
    {
        $this->geocode('127.0.0.1')->first()->getLocality()->shouldReturn('localhost');
        $this->geocode('127.0.0.1')->first()->getCountry()->getName()->shouldReturn('localhost');
        $this->geocode('::1')->first()->getLocality()->shouldReturn('localhost');
        $this->geocode('::1')->first()->getCountry()->getName()->shouldReturn('localhost');
    }

    public function ipToCityExamples()
    {
        return [
            ['109.227.227.191', 'Томск'],
            ['91.221.60.82', 'Томск'],
            ['213.180.193.3', 'Москва'],
            ['195.93.187.10', 'Новосибирск'],
        ];
    }
}
