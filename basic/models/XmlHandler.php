<?php

namespace app\models;


class XmlHandler
{

    public $OptionList = array();

    public function __construct($xml)
    {
        foreach ($xml->ShopOptions as $element)
        {
            $optionObject = new ShopOptions($element);
            $this->OptionList[] = $optionObject;
        }

    }

}