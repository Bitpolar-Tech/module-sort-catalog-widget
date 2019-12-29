<?php
/**
 * @author Stefan Euchenhofer
 * @copyright Copyright (c) 2019 Bitpolar Technologies (https://www.bitpolar.de)
 * @package Bitpolar_SortCatalogWidget
 */
 
namespace Bitpolar\SortCatalogWidget\Plugin;

use Magento\Framework\DB\Select;
use Psr\Log\LoggerInterface;

class AfterCreateCollection
{

    protected $_logger;
    public function __construct(
        \Psr\Log\LoggerInterface $logger //log injection
    ) {
        $this->_logger = $logger;
    }

    public function aftercreateCollection($subject, $result)
    {
        /**
         * @var \Magento\Catalog\Model\ResourceModel\Product\Collection $result
         * @var \Magento\CatalogWidget\Block\Product\ProductsList $subject
         */
        // if there's a sort_by attribute defined, add a sort to the collection
        if ($subject->hasData('sort_by')) {
            // if there's a direction given, check and use that otherwise  use the default
            $direction = strtoupper($subject->getData('sort_direction'));
            if (!in_array($direction, [Select::SQL_DESC, Select::SQL_ASC])) {
                $direction = Select::SQL_DESC;
            }
            $result->getSelect()->reset(\Zend_Db_Select::ORDER);
            $result->addAttributeToSort($subject->getData('sort_by'), $direction);
        }

        // $this->_logger->log('log message');

        return $result;
    }
}
