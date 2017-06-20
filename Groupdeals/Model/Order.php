<?php
namespace Magecian\Groupdeals\Model;

class Order extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'groupdeals_dealpurchases';

    protected $_cacheTag = 'groupdeals_dealpurchases';

    protected $_eventPrefix = 'groupdeals_dealpurchases';

    protected function _construct()
    {
        $this->_init('Magecian\Groupdeals\Model\ResourceModel\Order');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getDealId()];
    }

}
