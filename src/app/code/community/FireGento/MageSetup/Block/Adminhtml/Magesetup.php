<?php
/**
 * This file is part of the FIREGENTO project.
 *
 * FireGento_MageSetup is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License version 3 as
 * published by the Free Software Foundation.
 *
 * This script is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * PHP version 5
 *
 * @category  FireGento
 * @package   FireGento_MageSetup
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2013 FireGento Team (http://www.firegento.de). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.4.0
 */
/**
 * Displays a form with some options to setup things
 *
 * @category  FireGento
 * @package   FireGento_MageSetup
 * @author    FireGento Team <team@firegento.com>
 * @copyright 2013 FireGento Team (http://www.firegento.de). All rights served.
 * @license   http://opensource.org/licenses/gpl-3.0 GNU General Public License, version 3 (GPLv3)
 * @version   $Id:$
 * @since     0.4.0
 */
class FireGento_MageSetup_Block_Adminhtml_Magesetup extends Mage_Adminhtml_Block_Widget
{
    /**
     * Class Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('MageSetup');
    }

    /**
     * Retrieve the POST URL for the form
     *
     * @return string URL
     */
    public function getPostActionUrl()
    {
        return $this->getUrl('*/*/save');
    }

    /**
     * Get old product tax classes
     *
     * @return array
     */
    public function getProductTaxClasses()
    {
        return Mage::getSingleton('magesetup/source_tax_productTaxClass')->getAllOptions();
    }

    /**
     * Get new product tax classes (yet to be created)
     *
     * @return array
     */
    public function getNewProductTaxClasses()
    {
        return Mage::getSingleton('magesetup/source_tax_newProductTaxClass')->getAllOptions();
    }

    /**
     * Retrieve the default default new product tax class (yet to be created)
     *
     * @return int
     */
    public function getDefaultProductTaxClass()
    {
        return Mage::getSingleton('magesetup/source_tax_newProductTaxClass')->getDefaultOption();
    }

    /**
     * Retrieve all locales where the directory email/template exists
     *
     * @return array
     */
    public function getLocaleOptionsForEmailTemplates()
    {
        $options = Mage::getSingleton('adminhtml/system_config_source_locale')->toOptionArray();
        foreach ($options as $key => $value) {
            $filePath = Mage::getBaseDir('locale')  . DS . $value['value'] . DS . 'template' . DS . 'email';
            if (!file_exists($filePath)) {
                unset($options[$key]);
            }
        }

        return $options;
    }

    /**
     * Retrieve all locales where the directory email/template exists
     *
     * @return array
     */
    public function getLocaleOptionsForCmsContent()
    {
        $options = Mage::getSingleton('adminhtml/system_config_source_locale')->toOptionArray();
        foreach ($options as $key => $value) {
            $filePath = Mage::getBaseDir('locale')  . DS . $value['value'] . DS . 'template' . DS . 'magesetup';
            if (!file_exists($filePath)) {
                unset($options[$key]);
            }
        }

        return $options;
    }

    /**
     * Check if there is more than one Store View
     *
     * @return bool
     */
    public function isMultiStore()
    {
        return (sizeof($this->getStores()) > 1);
    }

    /**
     * Retrieve all stores
     *
     * @return array
     */
    public function getStores()
    {
        return Mage::app()->getStores(false);
    }

    /**
     * Retrieve all available countries for MageSetup
     *
     * @return array
     */
    public function getAvailableCountriesForSetup()
    {
        return Mage::helper('magesetup')->getAvailableCountries();
    }
}
