<?php 

namespace HeimrichHannot;

class ModuleNewsReader extends \Contao\ModuleNewsReader
{
	public function generate()
	{
		if(\Environment::get('isAjaxRequest') && $this->news_template_modal)
		{
			$this->strTemplate = 'mod_newsreader_modal';
			$this->news_template = $this->news_template_modal;
			$strParent = parent::generate();

			$objArticle = \NewsModel::findPublishedByParentAndIdOrAlias(\Input::get('items'), $this->news_archives);

			if($objArticle !== null)
			{
				die($this->replaceInsertTags($strParent));
			}
		}
		
		return parent::generate();
	}
	
}
