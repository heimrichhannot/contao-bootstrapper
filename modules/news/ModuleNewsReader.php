<?php 

namespace HeimrichHannot;

class ModuleNewsReader extends \Contao\ModuleNewsReader
{
	public function generate()
	{
		if($this->Environment->isAjaxRequest && $this->news_template_modal)
		{
			$this->strTemplate = 'mod_newsreader_modal';
			$this->news_template = $this->news_template_modal;
			die($this->replaceInsertTags(parent::generate()));
		}
		
		return parent::generate();
	}
	
}