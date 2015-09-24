# Bootstrapper

Contao external CSS & JS assets groups with bootstrap and font-awesome support.

## Features

### Form/EFG

- Supports Ajax Form Handling. Support Messages can be easily configured inside the form, within a custom group like fieldsets.

### Module

#### ModuleNewsReader 
- Dispay news details as contao of bootstrap modal window, if selected news_full_modal.html5 template

## Bootstrapper form field eval extension
 
Option | Type | Default | InputTypes | Description
------ | ---- | ------- | ----------- | -----------
hideLabel | boolean | false | all | Hide label for this input
showGroupLabel | boolean | false | checkbox/radio | 
changeFile | string | Change | upload | Label that will be displayed when a file has been selected.
removeFile | string | Remove | upload | Label that will be displayed to remove file when a file has been selected.
fileIconClass | string | fa fa-file | upload | Icon css class that will be shown before the uploaded file name.
singleSelect | boolean | false | checkbox | Make a checkbox behave like radio buttons, with the option to disable a selection again. 
showDescription | boolean | false | all | Show the description label below the input as help-block (text replaced with error message in case).
inline | boolean | true | checkbox, radio | Show checkbox and radio inputs inline.
toolbar | string | undo redo &#124; bold italic &#124; bullist numlist outdent indent &#124; link unlink | textarea | Add a custom tinyMCE toolbar.
content_css | string | false | textarea | Add a valid location to an css file, that should be loaded as tinyMCE content.css.
