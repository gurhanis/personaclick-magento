<?php
/**
 * Copyright © 2017 PersonaClick. All rights reserved.
 */
namespace Personaclick\Personalization\Controller\Ajax;

class Products extends \Magento\Framework\App\Action\Action
{
    protected $_config;
    protected $_layoutFactory;
    protected $_resultRawFactory;

    public function __construct(
        \Personaclick\Personalization\Helper\Config $config,
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    )
    {
        $this->_config = $config;
        $this->_layoutFactory = $layoutFactory;
        $this->_resultRawFactory = $resultRawFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->_config->isPersonaclickEnabled()) {
            return '';
        }

        $output = $this->_layoutFactory->create()
            ->createBlock('Personaclick\Personalization\Block\Frontend\Products')
            ->setData('params', $this->getRequest()->getParams())
            ->toHtml();

        return $this->_resultRawFactory->create()->setContents($output);
    }
}
