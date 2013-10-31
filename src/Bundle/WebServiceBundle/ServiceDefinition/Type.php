<?php
/*
 * This file is part of the WebServiceBundle.
 *
 * (c) Christian Kerl <christian-kerl@web.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\WebServiceBundle\ServiceDefinition;

class Type
{
    private $phpType;
    private $xmlType;
    private $converter;

    public function __construct($phpType = null, $xmlType = null, $converter = null)
    {
        $this->setPhpType($phpType);
        $this->setXmlType($xmlType);
        $this->setConverter($converter);
    }

    public function getPhpType()
    {
        return $this->phpType;
    }

    public function setPhpType($value)
    {
        $this->phpType = $value;
    }

    public function getXmlType()
    {
        return $this->xmlType;
    }

    public function setXmlType($value)
    {
        $this->xmlType = $value;
    }

    public function getConverter()
    {
        return $this->converter;
    }

    public function setConverter($value)
    {
        $this->converter = $value;
    }
}