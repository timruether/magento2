<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Magento_Catalog
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Magento\Catalog\Model\Config\Source\Product;

/**
 * Catalog products per page on Grid mode source
 *
 * @category   Magento
 * @package    Magento_Catalog
 */
class Thumbnail implements \Magento\Core\Model\Option\ArrayInterface
{
    const OPTION_USE_PARENT_IMAGE = 'parent';
    const OPTION_USE_OWN_IMAGE = 'itself';

    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return array(
            array('value' => self::OPTION_USE_OWN_IMAGE, 'label' => __('Product Thumbnail Itself')),
            array('value' => self::OPTION_USE_PARENT_IMAGE, 'label' => __('Parent Product Thumbnail')),
        );
    }
}
