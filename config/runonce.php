<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2017 Heimrich & Hannot GmbH
 *
 * @author  Rico Kaltofen <r.kaltofen@heimrich-hannot.de>
 * @license http://www.gnu.org/licences/lgpl-3.0.html LGPL
 */

namespace HeimrichHannot\Bootstrapper;

class BootstrapperRunOnce extends \Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        if (class_exists('\HeimrichHannot\Bootstrapper\DatabaseUpdater')) {
            \HeimrichHannot\Bootstrapper\DatabaseUpdater::run();
        }
    }
}

$objRunOnce = new \HeimrichHannot\Bootstrapper\BootstrapperRunOnce();
$objRunOnce->run();