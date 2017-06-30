# Changelog
All notable changes to this project will be documented in this file.

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
