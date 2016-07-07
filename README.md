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

### Default assets components
Disable in Page-layout, if you dont want to use these components.

- bootstrap-select (styled select input with live-search, groups and mobile support)
- datetimepicker (styled datepicker with time and datepicker) 

To register custom js/css components, register them within '$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS']'.

```
$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS'] = array
(
	'bs.myplugin' =>  array
	(
		'js' => array
		(
		    'files' => array
		    (
			    'system/modules/bootstrapper/assets/vendor/my-plugin-library//js/my-plugin-library' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') .  '.js|static',
			    BOOTSTRAPPER_JS_COMPONENT_DIR . '/myplugin/bs.myplugin' . (!$GLOBALS['TL_CONFIG']['debugMode'] ? '.min' : '') . '.js|static',
			),
			'sort => 0 // this will add the js files before all other js files within TL_JAVASCRIPT
		),
		'css' => array
		(
		    'files' => array
            (
               'system/modules/bootstrapper/assets/vendor/my-plugin-library/my-plugin-library/css/my-plugin-library.css|screen|static|1.0.0'
            ),
			'sort => 0 // this will add the css files before all other css files within TL_USER_CSS
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
groupLabel | string | null | checkbox/radio |
changeFile | string | Change | upload | Label that will be displayed when a file has been selected.
removeFile | string | Remove | upload | Label that will be displayed to remove file when a file has been selected.
fileIconClass | string | fa fa-file | upload | Icon css class that will be shown before the uploaded file name.
singleSelect | boolean | false | checkbox | Make a checkbox behave like radio buttons, with the option to disable a selection again. 
showDescription | boolean | false | all | Show the description label below the input as help-block (text replaced with error message in case).
inline | boolean | true | checkbox, radio | Show checkbox and radio inputs inline.
toolbar | string | undo redo &#124; bold italic &#124; bullist numlist outdent indent &#124; link unlink | textarea | Add a custom tinyMCE toolbar.
content_css | string | false | textarea | Add a valid location to an css file, that should be loaded as tinyMCE content.css.
disableOptGroups | array | array() | select | Enter the name of the optgroups that should be disabled.
size | integer | | select | The value of the size attribute
linkedStart | string | | text | The selector of the start date/time input field linking to the end date/time input field (e.g. #ctrl_startDate).
linkedEnd | string | | text | The selector of the end date/time input field linking to the start date/time input field (e.g. #ctrl_endDate).
linkedUnlock | boolean | | text |
linkedLock | boolean | | text |
minDate | string | | text | A formatted date/time constraining the date/time picker to a certain minimum date/time.
maxDate | string | | text | A formatted date/time constraining the date/time picker to a certain maximum date/time.
minuteSteps | integer | text | The number of seconds in a minute
slider | array | | slider | Contains information for the bootstrap input slider
invisible | boolean | false | all | Determines whether a field should be invisible (css display: none); the field still is in the markup!

###### Bootstrapper input slider eval extension
 
| Name | Type |	Default |	Description |
| ---- |:----:|:-------:|:----------- |
| id | string | '' | set the id of the slider element when it's created |
| min |	float	| 0 |	minimum possible value |
| max |	float |	10 |	maximum possible value |
| step | float |	1 |	increment step |
| precision | float |	number of digits after the decimal of _step_ value |	The number of digits shown after the decimal. Defaults to the number of digits after the decimal of _step_ value. |
| orientation |	string | 'horizontal' |	set the orientation. Accepts 'vertical' or 'horizontal' |
| value |	float,array |	5	| initial value. Use array to have a range slider. |
| range |	bool |	false	| make range slider. Optional if initial value is an array. If initial value is scalar, max will be used for second value. |
| selection |	string |	'before' |	selection placement. Accepts: 'before', 'after' or 'none'. In case of a range slider, the selection will be placed between the handles |
| tooltip |	string |	'show' |	whether to show the tooltip on drag, hide the tooltip, or always show the tooltip. Accepts: 'show', 'hide', or 'always' |
| tooltip_split |	bool |	false |	if false show one tootip if true show two tooltips one for each handler |
| tooltip_position |	string |	null |	Position of tooltip, relative to slider. Accepts 'top'/'bottom' for horizontal sliders and 'left'/'right' for vertically orientated sliders. Default positions are 'top' for horizontal and 'right' for vertical slider. |
| handle |	string |	'round' |	handle shape. Accepts: 'round', 'square', 'triangle' or 'custom' |
| reversed | bool | false | whether or not the slider should be reversed |
| enabled | bool | true | whether or not the slider is initially enabled |
| formatter |	function |	returns the plain value |	formatter callback. Return the value wanted to be displayed in the tooltip |
| natural_arrow_keys | bool | false | The natural order is used for the arrow keys. Arrow up select the upper slider value for vertical sliders, arrow right the righter slider value for a horizontal slider - no matter if the slider was reversed or not. By default the arrow keys are oriented by arrow up/right to the higher slider value, arrow down/left to the lower slider value. |
| ticks | array | [ ] | Used to define the values of ticks. Tick marks are indicators to denote special values in the range. This option overwrites min and max options. |
| ticks_positions | array | [ ] | Defines the positions of the tick values in percentages. The first value should always be 0, the last value should always be 100 percent. |
| ticks_labels | array | [ ] | Defines the labels below the tick marks. Accepts HTML input. |
| ticks_snap_bounds | float | 0 | Used to define the snap bounds of a tick. Snaps to the tick if value is within these bounds. |
| scale | string | 'linear' | Set to 'logarithmic' to use a logarithmic scale. |
| focus | bool | false | Focus the appropriate slider handle after a value change. |
| labelledby | string,array | null | ARIA labels for the slider handle's, Use array for multiple values in a range slider. |
| value_callback | array('Class', 'function') | | callback function to set value|
| min_callback | array('Class', 'function') | | callback function to set min|
| max_callback | array('Class', 'function') | | macallback function to set max|
| step_callback | array('Class', 'function') | | callback function to set step|
| rangeLabels | array, null | array('min' => array('mode' => 'sync', 'suffix' => '', 'prefix => '', 'max' => array('mode' => 'sync', 'suffix' => '', 'prefix => '')) | Adjust min and max labels for range slider, or set to null if you want them to hide. Sync mode doest update values on slide changed.

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

