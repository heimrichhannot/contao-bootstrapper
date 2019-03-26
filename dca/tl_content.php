<?php

$arrDca = &$GLOBALS['TL_DCA']['tl_content'];

// Palettes
$arrDca['palettes']['__selector__'][]  = 'tabType';
$arrDca['palettes']['tabcontrol']      = '{type_legend},type,tabType';
$arrDca['palettes']['tabcontroltab']   =
    '{type_legend},type,headline,tabType;{tab_legend},tabControlCookies,tab_tabs,tabBehaviour,tabClasses,tab_remember;{tabcontrol_autoplay_legend:hide},tab_autoplay_autoSlide,tab_autoplay_delay,tab_autoplay_fade;{template_legend:hide},tab_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$arrDca['palettes']['tabcontrolstart'] =
    '{type_legend},type,tabType,parentTabControlTab;{tab_legend},tabClasses;{template_legend:hide},tab_template_start;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';
$arrDca['palettes']['tabcontrolstop']  =
    '{type_legend},type,tabType;{template_legend:hide},tab_template_stop;{protected_legend:hide},protected;{expert_legend:hide},guests';
$arrDca['palettes']['tabcontrol_end']  =
    '{type_legend},type,tabType;{template_legend:hide},tab_template_end;{protected_legend:hide},protected;{expert_legend:hide},guests';


$arrDca['subpalettes']['addImage'] = str_replace('floating', 'floating,background', $arrDca['subpalettes']['addImage']);
$arrDca['palettes']['image']       = str_replace('caption', 'caption,background', $arrDca['palettes']['image']);

// Fields
$arrDca['fields']['tabType'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tabType'],
    'default'   => 'tab',
    'exclude'   => true,
    'inputType' => 'radio',
    'options'   => [
        'tabcontroltab',
        'tabcontrolstart',
        'tabcontrolstop',
        'tabcontrol_end',
    ],
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['tabControl'],
    'eval'      => ['helpwizard' => true, 'submitOnChange' => true],
    'sql'       => "varchar(32) NOT NULL default ''",
];

$arrDca['fields']['parentTabControlTab'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['parentTabControlTab'],
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => ['tl_content_tabcontrol', 'getTabControlTabs'],
    'sql'              => "varchar(32) NOT NULL default ''",
];

$arrDca['fields']['tabClasses'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tabClasses'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => [
        'multiple' => true,
        'size'     => 2,
        'rgxp'     => 'alnum',
        'tl_class' => 'w50',
    ],
    'sql'       => "varchar(255) NOT NULL default ''",
];

$arrDca['fields']['tabBehaviour'] = [
    'label'     => $GLOBALS['TL_LANG']['tl_content']['tabBehaviour'],
    'exclude'   => true,
    'search'    => false,
    'inputType' => 'select',
    'options'   => ['click', 'mouseover'],
    'default'   => 'click',
    'reference' => &$GLOBALS['TL_LANG']['tl_content']['tabControl'],
    'eval'      => ['helpwizard' => true, 'tl_class' => 'w50'],
    'sql'       => "varchar(64) NOT NULL default ''",
];

$arrDca['fields']['tab_autoplay_autoSlide'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tabControl']['tab_autoplay_autoSlide'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50 m12'],
    'sql'       => "char(1) NOT NULL default '0'",
];

$arrDca['fields']['tab_autoplay_fade'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tabControl']['tab_autoplay_fade'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'w50'],
    'sql'       => "int(10) NOT NULL default '2500'",
];

$arrDca['fields']['tab_autoplay_delay'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tabControl']['tab_autoplay_delay'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => [
        'mandatory' => true,
        'nospace'   => true,
        'rgxp'      => 'digit',
        'tl_class'  => 'w50',
    ],
    'sql'       => "char(1) NOT NULL default '0'",
];

$arrDca['fields']['tabControlCookies'] = [
    'label'         => &$GLOBALS['TL_LANG']['tl_content']['tabControlCookies'],
    'exclude'       => true,
    'inputType'     => 'text',
    'eval'          => ['maxlength' => 128],
    'save_callback' => [
        ['tl_content_tabcontrol', 'generateCookiesName'],
    ],
    'sql'           => "varchar(128) NOT NULL default ''",
];

$arrDca['fields']['tab_tabs'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tab_tabs'],
    'exclude'   => true,
    'inputType' => 'multiColumnEditor',
    'eval'      => [
        'multiColumnEditor' => [
            'fields' => [
                'tab_tabs_name'          => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tab_tabs_name'],
                    'inputType' => 'text',
                    'eval'      => [
                        'mandatory' => true,
                        'groupStyle' => 'width:60%',
                        'allowHtml' => true,
                    ],
                ],
                'tab_tabs_cookies_value' => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tab_tabs_cookies_value'],
                    'inputType' => 'text',
                    'eval'      => ['groupStyle' => 'width:10%'],
                ],
                'tab_tabs_default'       => [
                    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tab_tabs_default'],
                    'exclude'   => true,
                    'inputType' => 'checkbox',
                    'eval'      => ['groupStyle' => 'width:10%',],

                ],
            ],
        ]
    ],
    'sql'       => "blob NULL",
];

$arrDca['fields']['tab_template'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['tab_template'],
    'default'          => 'ce_tabcontrol_tab',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [
        'tl_content_tabcontrol',
        'getTabcontrolTemplates',
    ],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$arrDca['fields']['tab_template_start'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['tab_template_start'],
    'default'          => 'ce_tabcontrol_start',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [
        'tl_content_tabcontrol',
        'getTabcontrolTemplates',
    ],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$arrDca['fields']['tab_template_stop'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['tab_template_stop'],
    'default'          => 'ce_tabcontrol_stop',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [
        'tl_content_tabcontrol',
        'getTabcontrolTemplates',
    ],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$arrDca['fields']['tab_template_end'] = [
    'label'            => &$GLOBALS['TL_LANG']['tl_content']['tab_template_end'],
    'default'          => 'ce_tabcontrol_end',
    'exclude'          => true,
    'inputType'        => 'select',
    'options_callback' => [
        'tl_content_tabcontrol',
        'getTabcontrolTemplates',
    ],
    'eval'             => ['tl_class' => 'w50'],
    'sql'              => "varchar(64) NOT NULL default ''",
];

$arrDca['fields']['tab_remember'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['tab_remember'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr'],
    'sql'       => "char(1) NOT NULL default ''",
];

$arrDca['fields']['background'] = [
    'label'     => &$GLOBALS['TL_LANG']['tl_content']['background'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => ['tl_class' => 'clr'],
    'sql'       => "char(1) NOT NULL default ''",
];


class tl_content_tabcontrol extends Backend
{

    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    public static function getTabControlTabs()
    {
        $arrOptions = [];

        if (($objContentElements = \ContentModel::findBy(['tl_content.type = ?', 'tabType = ?'], ['tabcontrol', 'tabcontroltab']))
            !== null
        ) {
            while ($objContentElements->next()) {
                $arrTabs = deserialize($objContentElements->tab_tabs, true);

                $arrOptions[$objContentElements->id] = 'ID ' . $objContentElements->id . (count($arrTabs) > 0 ? ': ' . implode(
                            ', ',
                            array_map(
                                function ($arrTab) {
                                    return $arrTab['tab_tabs_name'];
                                },
                                $arrTabs
                            )
                        ) : '');
            }
        }

        return $arrOptions;
    }

    /**
     * Return all tabcontrol templates as array
     */
    public function getTabcontrolTemplates(DataContainer $dc)
    {
        // Only look for a theme in the articles module (see #4808)
        if (Input::get('do') == 'article') {
            $intPid = $dc->activeRecord->pid;

            if (Input::get('act') == 'overrideAll') {
                $intPid = Input::get('id');
            }

            // Get the page ID
            $objArticle = $this->Database->prepare(
                "SELECT pid FROM tl_article WHERE id=?"
            )
                ->limit(1)
                ->execute($intPid);

            // Inherit the page settings
            $objPage = $this->getPageDetails($objArticle->pid);

            // Get the theme ID
            $objLayout = LayoutModel::findByPk($objPage->layout);

            if ($objLayout === null) {
                return [];
            }
        }

        $templateSnip = '';

        switch ($dc->activeRecord->tabType) {
            case 'tabcontrolstart':
                $templateSnip = 'start';
                break;

            case 'tabcontrolstop':
                $templateSnip = 'stop';
                break;

            case 'tabcontrol_end':
                $templateSnip = 'end';
                break;

            case 'tabcontroltab':
            default:
                $templateSnip = 'tab';
                break;
        }

        // Return all gallery templates
        return $this->getTemplateGroup(
            'ce_tabcontrol_' . $templateSnip,
            $objLayout->pid
        );
    }

    /**
     * Auto-generate the cookie name
     */
    public function generateCookiesName($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate alias if there is none
        if ($varValue == '') {
            $autoAlias = true;
            $varValue  = standardize(
                \StringUtil::restoreBasicEntities(
                    'tabControllCookie-' . $dc->activeRecord->id
                )
            );
        }

        $objAlias = $this->Database->prepare(
            "SELECT id FROM tl_content WHERE tabControlCookies=?"
        )->execute($varValue);

        // Check whether the cookies name alias exists
        if ($objAlias->numRows > 1 && !$autoAlias) {
            throw new Exception(
                sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue)
            );
        }

        // Add ID to cookies name
        if ($objAlias->numRows && $autoAlias) {
            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }
}
