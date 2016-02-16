<?php
namespace app\models;
use app\models\XmlHandler;

class ShopOptions
{
    public $airport_from;
    public $airport_to;
    public $departure_date;
    public $return_date;
    public $carrier;
    public $back;
    public $price;

    public $fareList = [
        'ADT' => 0,
        'CLD' => 0,
        'INF' => 0
    ];

    public function __construct($OptionElement)
    {
        $this->setFareList($OptionElement->ShopOption->FareInfo);
        $this->setItineraryList($OptionElement->ShopOption->ItineraryOptions);
        $this->setPrice($OptionElement);
    }

    private function setPrice($ShopOptions)
    {
        $this->price = $this->xml_attribute($ShopOptions->ShopOption, 'Total');
    }

    private function setItineraryList($ItineraryOptions)
    {
        $existItinerary = 0;

        if ( isset($ItineraryOptions->ItineraryOption[1]) )
            $existItinerary++;

        $this->departure_date = $this->xml_attribute($ItineraryOptions->ItineraryOption[0], 'Date');

        $this->return_date = $this->xml_attribute($ItineraryOptions->ItineraryOption[1], 'Date');

        $this->back = $existItinerary;

        $code = $this->xml_attribute($ItineraryOptions->ItineraryOption[0], 'From');
        $this->airport_from = Airports::getAirportIdByCode($code);


        $code = $this->xml_attribute($ItineraryOptions->ItineraryOption[0], 'To');
        $this->airport_to = Airports::getAirportIdByCode($code);

        $this->carrier =
            $this->xml_attribute($ItineraryOptions->ItineraryOption[0]->FlightSegment, 'Airline');
    }

    private function xml_attribute($object, $attribute)
    {
        if(isset($object[$attribute]))
            return (string) $object[$attribute];
    }

    private function setFareList($fareNode)
    {
        foreach ($fareNode->Fares->Fare as $fare )
        {
            $age_attr = $this->xml_attribute($fare->PaxType, 'AgeCat');
            $count_attr = $this->xml_attribute($fare->PaxType, 'Count');
            $this->fareList[$age_attr] = $count_attr;
        }
    }
}