<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Model\Config\Source\Api;

class Category implements \Magento\Framework\Option\ArrayInterface
{
    protected $_api;
    protected $_options;

    public function __construct(
        \Personaclick\Personalization\Helper\Api $api
    )
    {
        $this->_api = $api;
    }

    public function toOptionArray()
    {
        if (!$this->_options) {
            foreach ($this->_api->personaclickShopCategories() as $category) {
                $this->_options[$category['id']] = [
                    'label' => $category['name'],
                    'value' => $category['id'],
                ];
            }
        }

        asort($this->_options);

        $options = $this->_options;

        return $options;
    }
}
