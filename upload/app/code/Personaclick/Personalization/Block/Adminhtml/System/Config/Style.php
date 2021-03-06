<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Block\Adminhtml\System\Config;

class Style extends \Magento\Config\Block\System\Config\Form\Field
{
    protected $_config;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Personaclick\Personalization\Helper\Config $config,
        array $data = []
    )
    {
        $this->_config = $config;

        parent::__construct($context, $data);
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (!$this->getTemplate()) {
            if (!$this->_config->isPersonaclickEnabled()) {
                $this->setTemplate('system/config/style.phtml');
            } else {
                $this->setTemplate('system/config/style_auth.phtml');
            }
        }

        return $this;
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->_toHtml();
    }
}
