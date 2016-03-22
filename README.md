# Bootstrapper

Contao external CSS & JS assets groups with bootstrap and font-awesome support.

## Features

- Adds the bootstrap-slider as inputType to the FE

### Form/EFG

- Supports Ajax Form Handling. Support Messages can be easily configured inside the form, within a custom group like fieldsets.

### Module

#### ModuleNewsReader 
- Display news details as contao of bootstrap modal window, if selected news_full_modal.html5 template

## Bootstrapper asset components

To register custom js/css components, register them within '$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS']'.

```
$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS'] = array
(
	'bs.myplugin' =>  array
	(
		'js' => array
		(
			'system/modules/bootstrapper/assets/vendor/my-plugin-library//js/my-plugin-library' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') .  '.js|static',
			BOOTSTRAPPER_JS_COMPONENT_DIR . '/myplugin/bs.myplugin' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
		),
		'css' => array
		(
			'system/modules/bootstrapper/assets/vendor/my-plugin-library/my-plugin-library/css/my-plugin-library.css|screen|static|1.0.0'
		),
	),
);
```

## Bootstrapper form field eval extension
 
Option | Type | Default | InputTypes | Description
------ | ---- | ------- | ----------- | -----------
hideLabel | boolean | false | all | Hide label for this input
explanation | string | null | all | Adds an explanation to the input
showGroupLabel | boolean | false | checkbox/radio | 
changeFile | string | Change | upload | Label that will be displayed when a file has been selected.
removeFile | string | Remove | upload | Label that will be displayed to remove file when a file has been selected.
fileIconClass | string | fa fa-file | upload | Icon css class that will be shown before the uploaded file name.
singleSelect | boolean | false | checkbox | Make a checkbox behave like radio buttons, with the option to disable a selection again. 
showDescription | boolean | false | all | Show the description label below the input as help-block (text replaced with error message in case).
inline | boolean | true | checkbox, radio | Show checkbox and radio inputs inline.
toolbar | string | undo redo &#124; bold italic &#124; bullist numlist outdent indent &#124; link unlink | textarea | Add a custom tinyMCE toolbar.
content_css | string | false | textarea | Add a valid location to an css file, that should be loaded as tinyMCE content.css.
disableOptGroups | array | array() | select | Enter the name of the optgroups that should be disabled.
linkedStart | string | | text | The selector of the start date/time input field linking to the end date/time input field (e.g. #ctrl_startDate).
linkedEnd | string | | text | The selector of the end date/time input field linking to the start date/time input field (e.g. #ctrl_endDate).
linkedUnlock | boolean | text | ???
linkedLock | boolean | text | ???
minDate | string | text | A formatted date/time constraining the date/time picker to a certain minimum date/time.
maxDate | string | text | A formatted date/time constraining the date/time picker to a certain maximum date/time.
minuteSteps | integer | text | The number of seconds in a minute
slider | array | | slider | Contains information for the bootstrap input slider

###### Bootstrapper input slider eval extension
 
Option | Type | Default | Description
------ | ---- | ------- | -----------
value | integer | 5 | initial value
min | integer | 0 | minimum possible value
max | integer | 10 | maximum possible value
step | integer | 1 | increment step
value_callback | array('Class', 'function') | | callback function to set value
min_callback | array('Class', 'function') | | callback function to set min
max_callback | array('Class', 'function') | | macallback function to set max
step_callback | array('Class', 'function') | | callback function to set step

## Bootstrapper form field callbacks

Option | Type | Default | InputTypes | Description
------ | ---- | ------- | ----------- | -----------
option_callback | array of valid callbacks | array() | select/checkbox/radio | A callback to modify the data of an single option.

## Bootstrapper inserttags

Tag | Arguments | Example
------ | ---- | ------- 
btn | Buttton Class :: Button text | {{btn::btn-primary visible-ios::download now}}
btn-dropdown | Button Class :: Button Text :: n Links separated by :: | {{btn-dropdown::btn-primary::download now::App Store::Google play}} 

## Form templates		
		
- Naming convention for custom form field templates is defined as: ```bootstrapper_form_[type]_[name of your form field].html5``` e.g. "bootstrapper_form_upload_myfiles.html"
