<?php
/**
 
 */

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends \Magento\Backend\App\Action
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
        \Magecian\Groupdeals\Model\ResourceModel\Deal\CollectionFactory $_dealCollectionFactory
    ) {
        $this->_jsHelper = $jsHelper;
        $this->_dealCollectionFactory = $_dealCollectionFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        
        $dealId = $this->getRequest()->getParam('id');
        $PId = $this->getRequest()->getParam('product_id');
         /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($dealId) {
            
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $model = $objectManager->create('Magecian\Groupdeals\Model\Deal');
            $model->load($dealId);
            $model->delete();
           try {

                 $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                 $_product = $objectManager->create('\Magento\Catalog\Model\Product');
                 $_product->load($PId); 
                 $_product->setDealStatus(0);
                 $_product->setSpecialPrice(null);
                 $_product->getResource()->saveAttribute($_product, 'special_price');  
                 $_product->save();
                 $model->save();
                $this->messageManager->addSuccess(__('Deal has been deleted.'));
                $resultRedirect->setPath('magecian_groupdeals/deal/activedeals');
                return $resultRedirect;

            } catch (\Exception $e) {
                
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                //$resultRedirect->setPath('magecian_groupdeals/deal/activedeals', ['deal_id' => $dealId]);
                return $resultRedirect;
            }
        }
        // display error message
        $this->messageManager->addError(__('Deal was not found.'));
        // go to grid
        $resultRedirect->setPath('magecian_groupdeals/deal/newdeal');
        return $resultRedirect;
    }

}
