<?php
/**
 * Form Element Select Data Model
 *
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
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Customer\Model\Metadata\Form;

use Magento\App\RequestInterface;
use Magento\Customer\Model\Metadata\ElementFactory;

class Select extends AbstractData
{
    /**
     * {@inheritdoc}
     */
    public function extractValue(RequestInterface $request)
    {
        return $this->_getRequestValue($request);
    }

    /**
     * {@inheritdoc}
     */
    public function validateValue($value)
    {
        $errors     = array();
        $attribute  = $this->getAttribute();
        $label      = __($attribute->getStoreLabel());

        if ($value === false) {
            // try to load original value and validate it
            $value = $this->_value;
        }

        if ($attribute->isRequired() && empty($value) && $value !== '0') {
            $errors[] = __('"%1" is a required value.', $label);
        }

        if (!$errors && !$attribute->isRequired() && empty($value)) {
            return true;
        }

        if (count($errors) == 0) {
            return true;
        }

        return $errors;
    }

    /**
     * {@inheritdoc}
     */
    public function compactValue($value)
    {
        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function restoreValue($value)
    {
        return $this->compactValue($value);
    }

    /**
     * Return a text for option value
     *
     * @param string|int $value
     * @return string
     */
    protected function _getOptionText($value)
    {
        foreach ($this->getAttribute()->getOptions() as $option) {
            if ($option->getValue() == $value && !is_bool($value)) {
                return $option->getLabel();
            }
        }
        return '';
    }

    /**
     * Return formated attribute value from entity model
     *
     * @param string $format
     * @return string
     */
    public function outputValue($format = ElementFactory::OUTPUT_FORMAT_TEXT)
    {
        $value = $this->_value;
        if ($format === ElementFactory::OUTPUT_FORMAT_JSON) {
            $output = $value;
        } elseif ($value != '') {
            $output = $this->_getOptionText($value);
        } else {
            $output = '';
        }

        return $output;
    }
}
