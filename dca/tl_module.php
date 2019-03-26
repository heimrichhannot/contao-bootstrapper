<?php

$dc = &$GLOBALS['TL_DCA']['tl_module'];

$dc['palettes']['newsreader'] = str_replace('news_template', 'news_template, news_template_modal', $dc['palettes']['newsreader']);

$arrFields = [
    'news_template_modal' => [
        'label'            => &$GLOBALS['TL_LANG']['tl_module']['news_template_modal'],
        'exclude'          => true,
        'inputType'        => 'select',
        'options_callback' => ['tl_module_bootstrapper_news', 'getNewsTemplates'],
        'eval'             => ['tl_class' => 'w50', 'includeBlankOption' => true],
        'sql'              => "varchar(32) NOT NULL default ''"
    ]
];

$dc['fields'] = array_merge($dc['fields'], $arrFields);


class tl_module_bootstrapper_news extends \Backend
{

    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    /**
     * Return all news templates as array
     * @return array
     */
    public function getNewsTemplates()
    {
        return $this->getTemplateGroup('news_');
    }
}