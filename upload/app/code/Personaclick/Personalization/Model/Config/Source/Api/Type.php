<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Model\Config\Source\Api;

class Type implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'interesting', 'label' => __('You May Also Like')],
            ['value' => 'also_bought', 'label' => __('Frequently Bought Together')],
            ['value' => 'similar', 'label' => __('Similar Products')],
            ['value' => 'popular', 'label' => __('Popular Products')],
            ['value' => 'see_also', 'label' => __('Recommended For You')],
            ['value' => 'recently_viewed', 'label' => __('You Recently Viewed')],
            ['value' => 'buying_now', 'label' => __('Trending Products')],
            ['value' => 'search', 'label' => __('Customers Who Looked For This Item Also Bought')],
            ['value' => 'supply', 'label' => __('Regular Purchase')],
        ];
    }
}
