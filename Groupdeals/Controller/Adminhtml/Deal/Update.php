<?php
/**

 */
namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Update extends \Magento\Backend\App\Action
{

  protected $resultPageFactory;
  protected $_coreRegistry = null;

  public function __construct(
      Context $context,
      PageFactory $resultPageFactory,
      \Magento\Framework\Registry $registry
  ) {
      parent::__construct($context);
      $this->resultPageFactory = $resultPageFactory;
       $this->_coreRegistry = $registry;
  }
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Magecian_Groupdeals::update');
    }

    public function execute()
    {
        $Id = $this->getRequest()->getParam('deal_id');
        $productId = $this->getRequest()->getParam('product_id');
        $productName = $this->getRequest()->getParam('product_name');
        
        $model = $this->_objectManager->create('Magecian\Groupdeals\Model\Deal');
      
        $resultPage = $this->resultPageFactory->create();
        
        if (!$Id) {

                
                $this->messageManager->addError(__('This Product no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'magecian_groupdeals/deal/newdeal',
                    [
                        'deal_id' => $Id,
                        '_current' => true,
                    ]
                );
                return $resultRedirect;
        }else{

        $resultPage->setActiveMenu('Magecian_Groupdeals::newdeal');
        $resultPage->addBreadcrumb(__('New Deal'), __('New Deal'));
        $resultPage->getConfig()->getTitle()->prepend(__('Create New Deal'));
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        $model->load($Id);
        $this->_coreRegistry->register('magecian_groupdeals', $model);
        }
        if (!empty($data)) {
          $model->setData($data);
          $model->save();
        }
        
        return $resultPage;
    }
}
