<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2015 Heimrich & Hannot GmbH
 *
 * @package bootstrapper
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;

define('BOOTSTRAPPER_FILE_EXISTS_CLASS', 'fileinput-exists');
define('BOOTSTRAPPER_FILE_NEW_CLASS', 'fileinput-new');


class BootstrapperFormFileUpload extends BootstrapperFormField
{
    protected $strTemplate = 'bootstrapper_form_upload';

    protected $uploaded = false;

    protected function compile()
    {
        $this->Template->changeFile    = $this->getSetting(BOOTSTRAPPER_OPTION_CHANGEFILE);
        $this->Template->removeFile    = $this->getSetting(BOOTSTRAPPER_OPTION_REMOVEFILE);
        $this->Template->fileIconClass = $this->getSetting(BOOTSTRAPPER_OPTION_FILEICONCLASS);

        // if upload succeeded a valid uuid must exist in activeRecord
        $this->uploaded = \Validator::isUuid($this->objWidget->activeRecord->{$this->objWidget->name});

        if ($this->uploaded) {
            $this->Template->filename  = $_SESSION['FILES'][$this->objWidget->name]['name'];
            $this->Template->value     = $this->objWidget->activeRecord->{$this->objWidget->name};
            $this->Template->fileClass = BOOTSTRAPPER_FILE_EXISTS_CLASS;
        } else {
            $this->Template->fileClass = BOOTSTRAPPER_FILE_NEW_CLASS;
        }

        $this->Template->uploaded = $this->uploaded;
    }
}