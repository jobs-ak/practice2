<?php
/**
 */
namespace Magecian\Groupdeals\Block\Product\View;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
class DealName extends \Magento\Framework\View\Element\Template
{
  

   /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    protected $percentage;
    protected $_priceCurrency;
    protected $date;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    protected $_dealCollectionFactory;
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $timezone,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfigInterface,
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $dealCollectionFactory,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Registry $registry,
        \Magecian\Groupdeals\Helper\Data $dataHelper,
        Context $context,
        array $data)
    {
        $this->setStoreTimezone();
        $this->date = $date;
        $this->_priceCurrency = $priceCurrency;
        $this->_scopeConfig= $scopeConfigInterface;
        $this->_dealCollectionFactory = $dealCollectionFactory;
        $this->dataHelper = $dataHelper;  
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }
    
     protected function construct(){
        parent::_construct();
    }
     
    public function getdealName($currentProductId)
    {
        $resultPage = $this->_dealCollectionFactory->create()
                    ->addFieldToFilter('product_id',['eq'=> $currentProductId])
                     ->addFieldToFilter('is_active',['like'=> 1])
                     ->addFieldToFilter('close_state',['like'=> 0])
                     ->load();
        if(count($resultPage) != 0):
        $dName = $resultPage->getData();
        foreach($dName as $name){
         $fname = $name['deal_name'];
        }
        return $fname;
        endif;
        return null;
    }
  
    public function getCurrentProduct()
    {       
        return $this->_coreRegistry->registry('current_product');
    }  
    
}
