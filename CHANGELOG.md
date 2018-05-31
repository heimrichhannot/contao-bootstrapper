# Changelog
All notable changes to this project will be documented in this file.

## [3.0.11-beta] - 2018-05-31

### Fixed
- remove `typeof($.fn.dropdown) !== 'undefined'` for proper encore-bundle and footer js support

## [3.0.10-beta] - 2018-04-17

### Fixed
- adjusted `ce_accordion*` templates to make work with bootstrap 4, migrate `panel` to `cards` and fixed parentID

## [3.0.9-beta] - 2018-04-13

### Fixed
- set `dateStr` and `placeholder` for current `flatprickr-mobile` 
- restored `btn-` class swap between `ce_hyperlink` div and nested `anchor`

### Added
- add wrapper to `flatpickr-mobile` 

## [3.0.8-beta] - 2018-04-12

### Fixed
- `button_dropdown` component

## [3.0.7-beta] - 2018-04-11

### Added
- `eval` attribute `inputGroupPrepend` and `inputGroupPrepend` to add custom text input-group-append or input-group-prepend input-groups 

## [3.0.6-beta] - 2018-04-11

### Fixed
- flatpickr linked pickers

## [3.0.5-beta] - 2018-03-27

### Added
- add `animate.css` component to better disable css

## [3.0.4-beta] - 2018-03-26

### Fixed
- replaced missing multiColumnWizard with multiColumnEditor 

## [3.0.3-beta] - 2018-03-05

### Fixed
- added minified versions of bootbox and fastclick

## [3.0.2-beta] - 2018-02-22

### Fixed
- use decodeURIComponent within `bs.collapse` when using hash as selector for special characters like umlauts

## [3.0.1-beta] - 2018-02-09

### Fixed
- checkboxes (make usage of `custom-control-input`) and input-groups within form widgets

## [3.0.0-beta] - 2018-02-09

### Changed
- use bootstrap 4.0 stable

