<?php
namespace Magecian\Groupdeals\Helper;
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $_backendUrl;
    /**
     * @var \Magento\Store\Model\StoreManagerInterface $storeManager
     */
    protected $storeManager;
    /**
     * @param \Magento\Framework\App\Helper\Context   $context
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     */
    protected $_dealCollectionFactory;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $_dealCollectionFactory
    ) {
        parent::__construct($context);
        $this->_backendUrl = $backendUrl;
        $this->storeManager = $storeManager;
        $this->_dealCollectionFactory = $_dealCollectionFactory;
        $this->_date =  $date;
       
    }
    public function getConfig($config_path)
      {
       return $this->scopeConfig->getValue(
            $config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
            );
      }
   
    public function getOrdersGridUrl()
    {
        return $this->_backendUrl->getUrl('magecian_groupdeals/deal/orders', ['_current' => true]);
    }
    
   
   public function getDealProductId($productId){
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $DealCollection = $objectManager->create('Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory');
      $collection = $DealCollection->create()
            ->addFieldToFilter('product_id',['eq'=>$productId])
            ->addFieldToFilter('is_active',['like'=> 1])
            ->addFieldToFilter('close_state',['like'=> 0])
            ->load();
      if(count($collection) != 0){
        
      foreach ($collection as $product):
          $dealPrice =  $product->getPrice();
        endforeach;
        return $dealPrice; 
      } 
      return 0;
    }

    public function getidbyproductid($data)
    {
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $DealCollection = $objectManager->create('Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory');
      $Qtycollection = $DealCollection->create()
            ->addFieldToSelect('id')
            ->addFieldToFilter('product_id',['eq'=> $data])
            ->load();
     foreach( $Qtycollection as $data_id):
     return $data_id['id'] ;
     endforeach;
     return false;
    }  
     
    public function getUpdateDealQty($ProOrder,$ProQty){
      
       $id = $this->getidbyproductid($ProOrder);
       $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
       $model = $objectManager->create('Magecian\Groupdeals\Model\Deal');
       $model->load($id);
       $dealQty =  $model->getQtyToReachDeal();
       $purQty =  $model->getPurchasesLeft();
       if($dealQty != $purQty):
       $updatedQty = $purQty + $ProQty;  
       $model->setPurchasesLeft($updatedQty);
       endif;
       $model->save();
      
    }
 
  
    public function getDealclosed($Id,$ProductId,$Afrom,$AvaTo){
        $date1 =  $this->_date->date($Afrom)->format('Y-m-d H:i:s');
        $date2 =  $AvaTo;
       
       $seconds = strtotime($date2) - strtotime($date1);
       $days    = floor($seconds / 86400);

      if($days < 0):
     
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $model = $objectManager->create('Magecian\Groupdeals\Model\Deal');
      $model->load($Id);
      $close = $model->getCloseState();
      $model->setIsActive(0);
      //if($close == 0):
      $model->setCloseState(1);
      $model->setIsSuccess(1);
      $_product = $objectManager->create('\Magento\Catalog\Model\Product');
      $_product->load($ProductId); 
      $_product->setDealStatus(0);
      $_product->setSpecialPrice(null);
      $_product->getResource()->saveAttribute($_product, 'special_price');     	    
      $_product->save();
      /* $checkoutSession = $this->getCheckoutSession();
      $allItems = $checkoutSession->getQuote()->getAllVisibleItems();//returns all teh items in session
      foreach ($allItems as $item) {
            $itemId = $item->getItemId();//item id of particular item
            $quoteItem=$this->getItemModel()->load($itemId);//load particular item which you want to delete by his item id
            $quoteItem->delete();//deletes the item
      }*/
      
     // endif;
      $model->save();
      endif;
      return true;
    }
     public function getDealcheck($dealId,$ProductId){
      $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
      $model = $objectManager->create('Magecian\Groupdeals\Model\Deal');
      $model->load($dealId);
      $is_success = $model->getIsSuccess(); 
      if($is_success == 1):
      $model->setIsSuccess(0);
      endif;
      $model->save();
      return true;
    }

    public function getDealstatus($ProOrder)
        {
         $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
         $DealCollection = $objectManager->create('Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory');
         $collection = $DealCollection->create()
            ->addFieldToFilter('product_id',['eq'=>$ProOrder])
            ->addFieldToFilter('close_state',['eq'=>0])
            ->addFieldToFilter('is_active',['eq'=>1])
            ->load();
        if(count($collection) > 0):
        return 1;
        endif;
        return 0;
        }

    public function getCheckoutSession(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();//instance of object manager 
        $checkoutSession = $objectManager->get('Magento\Checkout\Model\Session');//checkout session
        return $checkoutSession;
    }
     
    public function getItemModel(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();//instance of object manager
        $itemModel = $objectManager->create('Magento\Quote\Model\Quote\Item');//Quote item model to load quote item
        return $itemModel;
    }
          
}
