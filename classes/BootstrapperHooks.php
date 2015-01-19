<?php

namespace HeimrichHannot;

class BootstrapperHooks extends \Controller
{

	public function parseWidgetHook($strBuffer, $objWidget)
	{
		if(TL_MODE == 'BE') return $strBuffer;

		return Bootstrapper::generateForm($objWidget, strlen($objWidget->label) == 0);
	}

	public function processFormDataHook($arrSubmitted, $arrData, $arrFiles, $arrLabels, $objForm)
	{
		$formId = ($objForm->formID != '') ? 'auto_'.$objForm->formID : 'auto_form_'.$objForm->id;

		// Get all form fields
		$arrFields = array();
		$objFields = \FormFieldModel::findPublishedByPid($objForm->id); // default order by sorting

		$strReturn = null;

		if ($objFields !== null)
		{
			$start = false;

			while ($objFields->next())
			{
				if($objFields->successType == 'successStart')
				{
					$start = true;
				}

				if($start || !$objForm->hideFormOnSuccess)
				{
					$arrFields[] = $objFields->current();
				}

				if($objFields->successType == 'successStop')
				{
					$start = false;
				}
			}
		}

		if (!empty($arrFields) && is_array($arrFields))
		{
			$row     = 0;
			$max_row = count($arrFields);

			foreach ($arrFields as $objField) {
				$strClass = $GLOBALS['TL_FFL'][$objField->type];

				// Continue if the class is not defined
				if (!class_exists($strClass)) {
					continue;
				}

				$arrData = $objField->row();

				$arrData['decodeEntities'] = true;
				$arrData['allowHtml'] = $objForm->allowTags;
				$arrData['rowClass'] = 'row_'.$row . (($row == 0) ? ' row_first' : (($row == ($max_row - 1)) ? ' row_last' : '')) . ((($row % 2) == 0) ? ' even' : ' odd');
				$arrData['tableless'] = $objForm->tableless;

				// Increase the row count if its a password field
				if ($objField->type == 'password')
				{
					++$row;
					++$max_row;

					$arrData['rowClassConfirm'] = 'row_'.$row . (($row == ($max_row - 1)) ? ' row_last' : '') . ((($row % 2) == 0) ? ' even' : ' odd');
				}

				// Submit buttons do not use the name attribute
				if ($objField->type == 'submit')
				{
					$arrData['name'] = '';
				}

				// Unset the default value depending on the field type (see #4722)
				if (!empty($arrData['value']))
				{
					if (!in_array('value', trimsplit('[,;]', $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$objField->type])))
					{
						$arrData['value'] = '';
					}
				}

				$objWidget = new $strClass($arrData);

				$objWidget->required = $objField->mandatory ? true : false;

				// HOOK: load form field callback
				if (isset($GLOBALS['TL_HOOKS']['loadFormField']) && is_array($GLOBALS['TL_HOOKS']['loadFormField']))
				{
					foreach ($GLOBALS['TL_HOOKS']['loadFormField'] as $callback)
					{
						$this->import($callback[0]);
						$objWidget = $this->$callback[0]->$callback[1]($objWidget, $formId, $arrData, $objForm);
					}
				}

				$strReturn .= $objWidget->parse();

				++$row;
			}
		}

		if($objForm->isAjaxForm && !is_null($strReturn))
		{
			$strReturn .= '<input type="hidden" name="FORM_SUBMIT" value="' . $formId . '">"';
			$strReturn .= '<input type="hidden" name="REQUEST_TOKEN" value="' . \RequestToken::get() . '">';
			die($strReturn);
		}
	}

	// Remove successgroup itself and child elements from forms
	public function compileFormFieldsHook($arrFields, $formId, &$objForm)
	{
		if($objForm->isAjaxForm)
		{
			$arrAttributes = deserialize($objForm->attributes, true);
			$arrAttributes[1] .= ($arrAttributes[1] != '' ? ' ' : '') . ' ajax-form';
			$objForm->attributes = serialize($arrAttributes);
		}

		$start = false;

		$arrReturn = $arrFields;

		foreach($arrFields as $key => $arrData)
		{
			if($arrData->type == 'successGroup' || $start)
			{
				if($arrData->successType == 'successStart')
				{
					$start = true;
				}

				if($start)
				{
					unset($arrReturn[$key]);
				}

				if($arrData->successType == 'successStop')
				{
					$start = false;
				}
			}
		}

		return $arrReturn;
	}


	public function replaceInsertTagsHooks($strTag)
	{
		$params = preg_split('/::/', $strTag);

		if(is_array($params) && !empty($params))
		{
			if(strpos($params[0], 'small') === 0)
			{
				return '<small>';
			}

			if(strpos($params[0], '/small') === 0)
			{
				return '</small>';
			}

			if(strpos($params[0], 'u') === 0)
			{
				return '<u>';
			}

			if(strpos($params[0], '/u') === 0)
			{
				return '</u>';
			}

			if(strpos($params[0], 'i') === 0)
			{
				$strClass = $params[1] ? ' class="' . $params[1] . '"':'';
				return '<i' . $strClass . '>';
			}

			if(strpos($params[0], '/i') === 0)
			{
				return '</i>';
			}

			if(strpos($params[0], 'loremipsum') === 0)
			{
				$text = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet
                a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu,
                consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
                Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi
                vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus
                eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam
                nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.
                Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros
                faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna.
                Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,';

				// trim length
				if(is_numeric($params[1]))
				{
					$text = \String::substr($text, $params[1]);
				}

				return $text;
			}
		}

		return false;
	}
}