<?php

namespace Magecian\Groupdeals\Block\Deals;


class Index extends \Magento\Framework\View\Element\Template {

   /**
   * @var \Magento\Framework\App\Config\ScopeConfigInterface
   */
   protected $scopeConfig;


   public function __construct(\Magento\Framework\View\Element\Template\Context $context,
   	\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

   	protected function _prepareLayout()
	{
		$required_loc = $this->scopeConfig->getValue('buybble_config/general/genabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $actionName       = $this->getRequest()->getFullActionName();
		$breadcrumbs      = $this->getLayout()->getBlock('breadcrumbs');
		if($actionName && $required_loc){
		$breadcrumbs->addCrumb(
					'home',
					[
						'label' => __('Home'),
						'title' => __('Go to Home Page'),
						'link'  => $this->_storeManager->getStore()->getBaseUrl()
					]
				)->addCrumb(
					'Deals',
					['label' => 'Deals', 'title' => 'Deals']
				);
    }}
   
}