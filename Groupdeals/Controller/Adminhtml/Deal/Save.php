<?php

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\TestFramework\ErrorLog\Logger;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Backend\Helper\Js
     */
    protected $_jsHelper;

    /**
     * @var \Magecian\Groupdeals\Model\ResourceModel\deal\CollectionFactory
     */
    protected $_dealCollectionFactory;

    /**
     * \Magento\Backend\Helper\Js $jsHelper
     * @param Action\Context $context
     */
    public function __construct(
        Context $context,
        \Magento\Backend\Helper\Js $jsHelper,
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $_dealCollectionFactory,
        \Magecian\Groupdeals\Helper\Data $dataHelper
    ) {
        $this->_jsHelper = $jsHelper;
        $this->dataHelper = $dataHelper;
        $this->_dealCollectionFactory = $_dealCollectionFactory;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return true;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = $objectManager->create('Magecian\Groupdeals\Model\Deal');
        // print_r($data);die;
        if ($data) {
             $id = $this->getRequest()->getParam('deal_id');
             $mainid = $this->dataHelper->getidbyproductid($id);
            /* if ($mainid) { $model->load($mainid);$model->delete();}*/
          
            
            $avaFrom = $this->getRequest()->getParam('available_from');
            $avaTo = $this->getRequest()->getParam('available_to');
            $price = $this->getRequest()->getParam('price');
            $Qty = $this->getRequest()->getParam('qty_to_reach_deal');
            $maxQty = $this->getRequest()->getParam('maximum_allowed_purchases ');
            
           
           
            $_product = $objectManager->create('\Magento\Catalog\Model\Product');
      	    $_product->load($id); 
            $_product->setSpecialPrice($price); //special price 
            $_product->setSpecialFromDate($avaFrom); //special price from (MM-DD-YYYY)
            $_product->setSpecialToDate($avaTo);      	    
            $_product->setDealStatus(1);

            
            $_product->save();
           
           try {
                $model->setData($data);
                $model->save();
                $this->messageManager->addSuccess(__('You saved this deal.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('magecian_groupdeals/deal/edit', ['deal_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('magecian_groupdeals/deal/activedeals');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('This Product Deal is already created or deleted.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('magecian_groupdeals/deal/edit', ['deal_id' => $this->getRequest()->getParam('deal_id')]);
        }
        return $resultRedirect->setPath('magecian_groupdeals/deal/newdeal');
    }

    /*public function saveSpecialPrice($id,$avaFrom,$avaTo,$price)
    {
      
    }*/

   /*  public function saveProducts($model, $post)
    {
        // Attach the attachments to contact
        if (isset($post['products'])) {
            $productIds = $this->_jsHelper->decodeGridSerializedInput($post['products']);
            try {
                $oldProducts = (array) $model->getProducts($model);
                $newProducts = (array) $productIds;

                $this->_resources = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\App\ResourceConnection');
                $connection = $this->_resources->getConnection();

                $table = $this->_resources->getTableName(\Webspeaks\ProductsGrid\Model\ResourceModel\Contact::TBL_ATT_PRODUCT);
                $insert = array_diff($newProducts, $oldProducts);
                $delete = array_diff($oldProducts, $newProducts);

                if ($delete) {
                    $where = ['contact_id = ?' => (int)$model->getId(), 'product_id IN (?)' => $delete];
                    $connection->delete($table, $where);
                }

                if ($insert) {
                    $data = [];
                    foreach ($insert as $product_id) {
                        $data[] = ['contact_id' => (int)$model->getId(), 'product_id' => (int)$product_id];
                    }
                    $connection->insertMultiple($table, $data);
                }
            } catch (Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the contact.'));
            }
        }

    }*/
}
