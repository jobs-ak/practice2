<?php
namespace Magecian\Groupdeals\Model;

class Deal extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'groupdeals_deal';

    protected $_cacheTag = 'groupdeals_deal';

    protected $_eventPrefix = 'groupdeals_deal';

    protected function _construct()
    {
        $this->_init('Magecian\Groupdeals\Model\ResourceModel\Deal');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getDealId()];
    }

    public function getProducts( Magecian\Groupdeals\Model\Deal $object)
    {
        $tbl = $this->getResource()->getTable(\Magecian\Groupdeals\Model\ResourceModel\Deal::TBL_ATT_PRODUCT);
        $select = $this->getResource()->getConnection()->select()->from(
            $tbl,
            ['product_id']
        )
        ->where(
            'id = ?',
            (int)$object->getId()
        );
        return $this->getResource()->getConnection()->fetchCol($select);
    }
}
