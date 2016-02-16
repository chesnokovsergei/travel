<?php
namespace app\models;

use app\models\XmlHandler;


class Search_Flight
{
    public $errors = array();

    public function Send_and_Save(XmlHandler $data)
    {
        foreach ( $data->OptionList as $element )
        {

            $flight = new Flights();

            $flight->from = $element->airport_from;
            $flight->to = $element->airport_to;
            $flight->back = $element->back;
            $flight->start = $element->departure_date;
            $flight->stop = $element->return_date;
            $flight->adult = $element->fareList['ADT'];
            $flight->child = $element->fareList['CLD'];
            $flight->infant = $element->fareList['INF'];
            $flight->price = $element->price;

            if (!$flight->save())
                array_push($this->errors, $flight->getErrors());
        }

    }

}
