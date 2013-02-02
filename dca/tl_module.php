<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @author     Christopher Bölter 2013
 * @copyright  Cogizz - web solutions <http://www.cogizz.de>
 * @package    MemberDataNotification
 * @license    LGPL
 */

/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['memberdatanotification'] = '{title_legend},name,headline,type;{config_legend},mdn_member_fields;mdn_message;jumpTo;{template_legend:hide},mdn_template;{expert_legend:hide},cssID';

/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_module']['fields']['mdn_member_fields'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mdn_member_fields'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'options_callback'        => array('tl_module', 'getEditableMemberProperties'),
    'eval'                    => array('multiple'=>true,'tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mdn_template'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mdn_template'],
    'default'                 => 'mod_mdn_default',
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => $this->getTemplateGroup('mod_mdn_'),
    'eval'                    => array('tl_class' => 'w50')
);

$GLOBALS['TL_DCA']['tl_module']['fields']['mdn_message'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_module']['mdn_message'],
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => array('tl_class' => 'long')
);

?>