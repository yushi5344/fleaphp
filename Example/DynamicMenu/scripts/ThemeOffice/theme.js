
// directory of where all the images are
var cmThemeOfficeBase = 'scripts/ThemeOffice/';

var cmThemeOffice =
{
    prefix:	'ThemeOffice',
  	// main menu display attributes
  	//
  	// Note.  When the menu bar is horizontal,
  	// mainFolderLeft and mainFolderRight are
  	// put in <span></span>.  When the menu
  	// bar is vertical, they would be put in
  	// a separate TD cell.

  	// HTML code to the left of the folder item
  	mainFolderLeft: ' ',
  	// HTML code to the right of the folder item
  	mainFolderRight: ' ',
	// HTML code to the left of the regular item
	mainItemLeft: ' ',
	// HTML code to the right of the regular item
	mainItemRight: ' ',

	// sub menu display attributes

	// 0, HTML code to the left of the folder item
	folderLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// 1, HTML code to the right of the folder item
	folderRight: '<img alt="" src="' + cmThemeOfficeBase + 'arrow.gif">',
	// 2, HTML code to the left of the regular item
	itemLeft: '<img alt="" src="' + cmThemeOfficeBase + 'spacer.gif">',
	// 3, HTML code to the right of the regular item
	itemRight: '<img alt="" src="' + cmThemeOfficeBase + 'blank.gif">',
	// 4, cell spacing for main menu
	mainSpacing: 0,
	// 5, cell spacing for sub menus
	subSpacing: 0,
	// 6, auto dispear time for submenus in milli-seconds
	delay: 500
};

// for horizontal menu split
var cmThemeOfficeHSplit = [_cmNoAction, '<td class="ThemeOfficeMenuItemLeft"></td><td colspan="2"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainHSplit = [_cmNoAction, '<td class="ThemeOfficeMainItemLeft"></td><td colspan="2"><div class="ThemeOfficeMenuSplit"></div></td>'];
var cmThemeOfficeMainVSplit = [_cmNoAction, ' '];
