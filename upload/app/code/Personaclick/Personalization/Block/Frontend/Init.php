<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Block\Frontend;

class Init extends \Magento\Framework\View\Element\Template
{
    protected $_config;
    protected $_cookie;
    protected $_track;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Personaclick\Personalization\Helper\Config $config,
        \Personaclick\Personalization\Helper\Cookie $cookie,
        \Personaclick\Personalization\Model\Track $track,
        array $data = []
    ) {
        $this->_config = $config;
        $this->_cookie = $cookie;
        $this->_track = $track;

        parent::__construct($context, $data);
    }

    public function getTrackingCode()
    {
        $js = '';
        $js .= 'r46(\'init\', \'' . $this->_config->getValue('personaclick/general/store_key') . '\');' . "\n";

        if ($this->_cookie->get('personaclick_customer')) {
            $js .= $this->_cookie->get('personaclick_customer');

            $this->_cookie->delete('personaclick_customer');
        }

        if ($this->_cookie->get('personaclick_cart')) {
            $js .= $this->_cookie->get('personaclick_cart');

            $this->_cookie->delete('personaclick_cart');
        }

        foreach ($this->_track->getJS() as $event) {
            $js .= $event;
        }

        return $js;
    }

    protected function _toHtml()
    {
        if (!$this->_config->isPersonaclickEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}
