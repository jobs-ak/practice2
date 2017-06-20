<?php
namespace Magecian\Groupdeals\Controller\Adminhtml;

abstract class Deal extends \Magento\Backend\App\Action
{

	public $postFactory;
  public $coreRegistry;
	public $resultRedirectFactory;

    public function __construct(
        \Magecian\Groupdeals\Model\DealFactory $postFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\App\Action\Context $context
    ) {

        $this->postFactory           = $postFactory;
        $this->coreRegistry          = $coreRegistry;
        $this->resultRedirectFactory = $context->getRedirect();
        parent::__construct($context);
    }

    /**
     
     */
	public function initPost()
    {
        $dealId  = (int) $this->getRequest()->getParam('id');
        $deal    = $this->postFactory->create();
        if ($dealId) {
            $deal->load($dealId);
        }
        $this->coreRegistry->register('magecian_groupdeals_newdeal', $deal);
        return $deal;
    }
}
