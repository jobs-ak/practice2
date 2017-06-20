<?php

namespace Magecian\Groupdeals\Block\Html;

use \Magento\Framework\View\Element\Template\Context;
use \Magecian\Groupdeals\Helper\Data;

class Footer extends \Magento\Framework\View\Element\Html\Link
{
    public $helper;

    public function __construct(
        Context $context,
        Data $helper,
        array $data = []
    ) {
    
        $this->helper = $helper;
        parent::__construct($context, $data);
    }

    public function getHref()
    {
        return __("Deal");
    }
	public function getLabel()
	{
		if ($this->helper->getDealConfig('general/name')==""){
			return __("Deal");
		}
		return $this->helper->getDealConfig('general/name');
	}
	public function getHtmlSiteMapUrl()
	{
		$moduleRoute = $this->helper->getDealConfig('general/url_prefix');
		if ($moduleRoute) {
			return $this->getBaseUrl() . $moduleRoute .'/sitemap/';
		}
		return $this->getBaseUrl() .'/mpdeal/sitemap/';
	}
}
