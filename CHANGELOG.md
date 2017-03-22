# Change Log
All notable changes to this project will be documented in this file.

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
