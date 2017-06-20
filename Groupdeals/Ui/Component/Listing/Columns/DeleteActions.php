<?php
/**

 */
namespace Magecian\Groupdeals\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;


class DeleteActions extends Column
{

    const URL_PATH_DELETE = 'magecian_groupdeals/deal/delete';
    const URL_PATH_UPDATE = 'magecian_groupdeals/deal/update';
  /**
   * @var UrlInterface
   */
  protected $urlBuilder;

  /**
   * @param ContextInterface $context
   * @param UiComponentFactory $uiComponentFactory
   * @param UrlInterface $urlBuilder
   * @param array $components
   * @param array $data
   */
  public function __construct(
      ContextInterface $context,
      UiComponentFactory $uiComponentFactory,
      UrlInterface $urlBuilder,
      array $components = [],
      array $data = []
  ) {
      $this->urlBuilder = $urlBuilder;
      parent::__construct($context, $uiComponentFactory, $components, $data);
  }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
      if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['id'])) {
                    $item[$this->getData('name')] = [
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_DELETE,
                                [
                                    'id' => $item['id'],
                                    'product_id' => $item['product_id']

                                ]
                               
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete "${ $.$data.name }"'),
                                'message' => __('Are you sure you wan\'t to delete the Deal "${ $.$data.name }" ?')
                            ]
                        ]
                    
                    /*'update' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_UPDATE,
                                [
                                    'id' => $item['deal_id']
                                ]
                            ),
                            'label' => __('update'),
                        ]*/
                    ];
                }
            }
        }
        return $dataSource;

    }
}
