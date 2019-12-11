# Changelog
All notable changes to this project will be documented in this file.

## [2.0-dev] - 2019-10-08
- added Contao 4 compatibility
- renamed fe_page template
- updated eonasdan-bootstrap-datetimepicker dependency
- updated bootstrap-select dependency
- updated various template for contao 4 compatibility

## [1.5.17] - 2019-05-09

### Fixed
- `Syntax error, unrecognized expression: #` js error when `data-parent="#"` in accordion start templates

## [1.5.16] - 2019-04-02

### Fixed
- `FormSlider` function getConfigValue on callable callbacks

## [1.5.15] - 2019-04-01

### Fixed
- `FormSlider` callback `value_callback` is triggered before value is validated and set

## [1.5.14] - 2019-04-01

### Fixed
- `FormSlider` min, max, range, value handling

## [1.5.13] - 2018-11-22

### Fixed
- `bs.scroll-smooth` for anchors on same page, now do not load front-page

## [1.5.12] - 2018-11-07

### Fixed
- using ajax forms and send submission through notification center did not work, because `processFormData` HOOK in `BootstrapperHooks` died in order to return ajax response (put notification_center beforehand in autoload.ini)

## [1.5.11] - 2018-11-07

### Fixed
- `bs.scroll-smooth`, removed marginBottom and make callable from outside plugin
- `bs.collapse`, now scrolls to collapse using `bs.scroll-smooth` plugin

### Added
- `bs.collapse` now supports `data-toggle-hash="false"` attribute on `.collapse` element to prevent toggle hash to url on shown collapse

## [1.5.10] - 2018-11-07

### Fixed
- Remove `IndexedDB` feature from modernizr build

## [1.5.9] - 2018-11-07

### Added
- $GLOBAL `TL_FFL_BOOTSTRAPPER_SKIP_TYPES` to completely ignore form manipulation for certain form types

## [1.5.8] - 2018-07-10

### Added
- Skip certain classes within parseWidget Hook

## [1.5.7] - 2018-02-22

### Fixed
- use decodeURIComponent within `bs.collapse` when using hash as selector for special characters like umlauts

## [1.5.6] - 2018-01-29

### Fixed
- Modernizr.touch replaced with Modernizr.touchevents within bootstrap-hover-dropdow

### Changed

- LGPL-3.0+ to LGPL-3.0-or-later

## [1.5.5] - 2018-01-11

### Fixed
- scrollTo inside .modal within bs.scroll-smooth js

## [1.5.4] - 2018-01-08

### Fixed
- removed console.log() in bs.scroll-smooth js

## [1.5.3] - 2017-12-19

### Fixed
- removed `HeimrichHannot\FormPasswordNoConfirm` from bootstrapper, moved to `heimrichhannot/contao-member_plus` previously

## [1.5.2] - 2017-12-19

### Fixed
- `tabcontrol` cookie handling for active tab

## [1.5.1] - 2017-11-28

### Fixed
- removed non existing js function

## [1.5.0] - 2017-11-28

### Changed
- added `heimrichhannot/contao-components` version 2.x support

### Fixed 
- linked Datetimepicker min/max date behavior

### Added
- inputType password_noConfirm -> bypass password confirmation in forms

## [1.4.13] - 2017-08-08

### Added
- inputType password_noConfirm -> bypass password confirmation in forms

## [1.4.12] - 2017-07-21

### Fixed
- location of blueimp gallery images
- blueimp gallery -> jump to selected image 

## [1.4.11] - 2017-07-21

### Fixed
- add unique data-gallery id for slick sliders within same page

## [1.4.10] - 2017-06-30

### Changed
- `multifileupload` fields are now styles by bootstrapper

## [1.4.9] - 2017-05-12

### Fixed
- bootstrapper modal interfere with `heimrichhannot/contao-modal` within ajax scope

## [1.4.8] - 2017-05-09

### Fixed
- php 7 support

## [1.4.7] - 2017-05-09

### Fixed
- php 7 support

## [1.4.6] - 2017-05-09

### Fixed
- php 7 support

## [1.4.5] - 2017-05-02

### Changed
- readded `multifileupload` to allowed field types for bootstrapper field replacement

## [1.4.4] - 2017-04-18

### Fixed
- added marginBottom of body on smooth-scroll

## [1.4.3] - 2017-04-11

### Changed
- added `multifileupload` to allowed field types for bootstrapper field replacement
- added eval `labelAfterField`, to render label after field for legacy form fields currently only! `bootstrapper_form.html5`

### Added
- php7 support


## [1.4.2] - 2017-03-22

### Fixed
- moved followAnchor from jquery.bootstrapper.js to component scrollSmooth and fixed behavior

## [1.4.1] - 2017-03-22

### Fixed
- `$GLOBALS['TL_COMPONENTS']` was overwritten not extended by bootstrapper

## [1.4.0] - 2017-03-21

### Changed
- `$GLOBALS['BOOTSTRAPPER_ASSET_COMPONENTS']` are now handled within new module `heimrichhannot/contao-components`, database updater comes with release to copy values form old tl_layout fields to new fields 

## [1.3.19] - 2017-02-08

### Changed
- BootstrapperFormField: fields can add the correct dca by themselves

## [1.3.18] - 2017-01-31

### Added
- added name and value attribute in button generation to enable export-button in frontend

## [1.3.17] - 2016-12-22

### Changed
- setHashFromCollapse, do not set hash for collapse when '.in' css class is present, otherwise will jump on every page load to collapse with '.in' class set

## [1.3.16] - 2016-12-13

### Added
- data-equal-height-breakpoint-min="768" added to "nav_navbar_collapse_hover.html5" to stop equal height behavior at 768px window width 

## [1.3.15] - 2016-12-05

### Changed
- showModal: href & data-title from link attributes is now taken into account to set document.title and url
- onCloseModal: history-base & history-base-title from modal data-attributes is now taken into account to restore document.title and url

## [1.3.14] - 2016-11-15

### Changed
- Update bootstrap-select to v1.11.2

## [1.3.13] - 2016-11-14

### Fixed
- fixed set minDate and maxDate for datetimepicker initially
