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
 * Class ModuleMemberDataNotification
 */
class ModuleMemberDataNotification extends Module
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_mdn_default';

    /**
     * Display a wildcard in the back end
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE') {
            $objTemplate = new BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### MODULE MEMBER DATA NOTIFICATION ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        // return if the user is not logged in
        if(!FE_USER_LOGGED_IN)
            return;

        return parent::generate();

    }


    /**
     * the module logic
     * @return string
     */
    protected function compile()
    {
        // Set template
        if (strlen($this->mdn_template))
        {
            $this->Template = new FrontendTemplate($this->mdn_template);
        }

        $this->loadLanguageFile('tl_member');
        $this->import("FrontendUser","User");
        $arrCheckFields = deserialize($this->mdn_member_fields);

        $arrMissingFields = array();

        foreach($arrCheckFields as $checkField) {
            if(!$this->User->{$checkField})
                $arrMissingFields[] = $GLOBALS['TL_LANG']['tl_member'][$checkField][0];
        }

        if(!count($arrMissingFields) > 0)
            return true;

        $objNextPage = $this->Database->prepare("SELECT * FROM tl_page Where id = ?")->execute($this->jumpTo);
        $strUrl = $this->generateFrontendUrl($objNextPage->row());

        $strLinkOpen = sprintf('<a href="%s" title="%s">', $strUrl, specialchars($objNextPage->title));
        $strLinkClose = '</a>';

        $strMissingFields = implode(', ', $arrMissingFields);

        $strMessage = $this->mdn_message;
        $strMessage = str_replace("%fields%",$strMissingFields, $strMessage);
        $strMessage = str_replace("%linkopen%",$strLinkOpen, $strMessage);
        $strMessage = str_replace("%linkclose%",$strLinkOpen, $strMessage);

        $this->Template->message = $strMessage;
        $this->Template->linkOpen = $strLinkOpen;
        $this->Template->linkClose = $strLinkClose;
        $this->Template->missingFields = $arrMissingFields;
    }
}

