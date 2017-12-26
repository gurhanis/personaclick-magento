<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Model;

class Track
{
    protected $_js = [];

    public function __construct() {

    }

    public function add($js)
    {
        $this->_js[] = $js;

        return $this;
    }

    public function getJS()
    {
        return $this->_js;
    }
}
