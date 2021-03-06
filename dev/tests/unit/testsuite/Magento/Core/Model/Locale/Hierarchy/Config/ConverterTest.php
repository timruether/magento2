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
 * @package     Magento_Core
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Core\Model\Locale\Hierarchy\Config;

class ConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Magento\Core\Model\Locale\Hierarchy\Config\Converter
     */
    protected $_model;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_configMock;

    protected function setUp()
    {
        $this->_model = new \Magento\Core\Model\Locale\Hierarchy\Config\Converter();
    }

    /**
     * @dataProvider composeLocaleHierarchyDataProvider
     */
    public function testComposeLocaleHierarchy($localeConfig, $localeHierarchy)
    {
        $dom = new \DOMDocument();
        $dom->loadXML($localeConfig);
        $this->assertEquals($localeHierarchy, $this->_model->convert($dom));
    }

    public function composeLocaleHierarchyDataProvider()
    {
        return array(
            array(
                'xml' => '<config><locale code="en_US" parent="en_UK" /><locale code="en_UK" parent="pt_BR"/></config>',
                array(
                    'en_US' => array('pt_BR', 'en_UK'),
                    'en_UK' => array('pt_BR'),
                )
            ),
            array(
                'xml' => '<config><locale code="en_US" parent="en_UK"/><locale code="en_UK" parent="en_US"/></config>',
                array(
                    'en_US' => array('en_UK'),
                    'en_UK' => array('en_US'),
                )
            ),
            array(
                'xml' => '<config></config>',
                array()
            ),
        );
    }
}
