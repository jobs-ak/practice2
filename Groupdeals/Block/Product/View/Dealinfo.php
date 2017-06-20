<?php
/**
 */
namespace Magecian\Groupdeals\Block\Product\View;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
class Dealinfo extends \Magento\Framework\View\Element\Template{
  
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
    
    
    public function dealCollection($currentProductId)
    {
        $resultPage = $this->_dealCollectionFactory->create()
                     ->addFieldToFilter('product_id',['like'=> $currentProductId])
                     ->addFieldToFilter('is_active',['like'=> 1])
                     ->load();
        return $resultPage->getData();
    }
    
    public function getCustomer()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->get('Magento\Customer\Model\Session');
        if($customerSession->isLoggedIn()) {
            $id= $customerSession->getId();
            $model = $objectManager->create('Magento\Customer\Model\Customer')->load($id);
            return $model;
        }
    }
    public function getDiscount($older,$newer){
      
     $percentage =  number_format(100 - ($newer / $older * 100), 2);
    
     return  $percentage;
            
    }
    public function getCurrentCurrencySymbol()
   {
     return $this->_priceCurrency->getCurrency()->getCurrencySymbol();
   }
     public function getCurrentProduct()
    {       
        return $this->_coreRegistry->registry('current_product');
    }   
   
}
