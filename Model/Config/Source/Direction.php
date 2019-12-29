<?php
/**
 * @author Stefan Euchenhofer
 * @copyright Copyright (c) 2019 Bitpolar Technologies (https://www.bitpolar.de)
 * @package Bitpolar_SortCatalogWidget
 */

namespace Bitpolar\SortCatalogWidget\Model\Config\Source;

use Magento\Framework\DB\Select;

class Direction implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => Select::SQL_DESC, 'label' => __('Descending')],
            ['value' => Select::SQL_ASC, 'label' => __('Ascending')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [Select::SQL_DESC => __('Descending'), Select::SQL_ASC => __('Ascending')];
    }
}
