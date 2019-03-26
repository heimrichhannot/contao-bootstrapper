<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2016 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper\Backend;

class Layout extends \Backend
{
    protected static $strTable = 'tl_layout';


    /**
     * Return all Bootstrapper Javascript Components
     * @param \DataContainer $dc
     *
     * @return array
     */
    public function getComponentsAsOption(\DataContainer $dc)
    {
        return \HeimrichHannot\Bootstrapper\BootstrapperAssets::getComponentGroups();
    }

}