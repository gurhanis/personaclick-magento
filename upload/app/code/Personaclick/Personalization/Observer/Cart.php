<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Observer;

class Cart implements \Magento\Framework\Event\ObserverInterface
{
    protected $_cookie;

    public function __construct(
        \Personaclick\Personalization\Helper\Cookie $cookie
    )
    {
        $this->_cookie = $cookie;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $js_data = array();

        foreach ($observer->getEvent()->getData('cart')->getQuote()->getAllVisibleItems() as $product) {
            $js_data[] = array(
                'id' => $product->getProductId(),
                'amount' => $product->getQty(),
            );
        }

        $js = 'r46(\'track\', \'cart\', ' . json_encode($js_data) . ');' . "\n";

        if ($this->_cookie->get('personaclick_cart')) {
            $js = $this->_cookie->get('personaclick_cart') . $js;
        }

        $this->_cookie->set('personaclick_cart', $js);
    }
}
