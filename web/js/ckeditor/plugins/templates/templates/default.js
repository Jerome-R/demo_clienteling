//Trigger Anniversaire d'Achat

var strVar_AA_FR="";
strVar_AA_FR += "Chère Madame / Cher Monsieur<br \/>";
strVar_AA_FR += "&nbsp;<br \/>";
strVar_AA_FR += "Cela fait déjà un an que nous avons eu le plaisir de vous accompagner pour l’acquisition de votre montre Claravista.<br\/>";
strVar_AA_FR += "&nbsp;<br \/>";
strVar_AA_FR += "Nous serions ravis de vous accueillir à nouveau. Nous pourrions à cette occasion réaliser gracieusement, <strong>un contrôle d'étenchéité<\/strong>*.<br\/>";
strVar_AA_FR += "&nbsp;<br \/>";
strVar_AA_FR += "Très cordialement,";

var strVar_AA_EN="";
strVar_AA_EN += "Dear Sir / Madam<br \/>";
strVar_AA_EN += "&nbsp;<br \/>";
strVar_AA_EN += "It has already been a year since we had the pleasure of the visit you made to us to acquire your Claravista watch.<br\/>";
strVar_AA_EN += "&nbsp;<br \/>";
strVar_AA_EN += "We would be delighted to welcome you again. If you wish, at that time we would be happy to offer you a <strong>complimentary maintenance service<\/strong>* for your bag.<br\/>";
strVar_AA_EN += "&nbsp;<br \/>";
strVar_AA_EN += "Yours Sincerely,";

var strVar_CP_FR="";
strVar_CP_FR += "Chère Madame / Cher Monsieur<br \/>";
strVar_CP_FR += "&nbsp;<br \/>";
strVar_CP_FR += "Nous serions ravis de vous accueillir lors de notre évènement annuel pour vous présenter la nouvelle collection 2017 Claravista, qui aura le lieu<br\/>";
strVar_CP_FR += "&nbsp;<br \/>";
strVar_CP_FR += "le 28 mai prochain dans boutique Claravista Paris.<br\/>";
strVar_CP_FR += "&nbsp;<br \/>";
strVar_CP_FR += "Une surprise vous y attendra !<br\/>";
strVar_CP_FR += "&nbsp;<br \/>";
strVar_CP_FR += "Très cordialement,";

/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

// Register a templates definition set named "default".
CKEDITOR.addTemplates( 'default', {
	// The name of sub folder which hold the shortcut preview images of the
	// templates.
	imagesPath: CKEDITOR.getUrl( CKEDITOR.plugins.getPath( 'templates' ) + 'templates/images/' ),

	// The templates definitions.
	templates: [ 
	{
		title: 'Trigger Anniversaire 1 - FR',
		image: 'template1.gif',
		description: '',
		html: strVar_AA_FR
	},
	{
		title: 'Trigger Anniversaire 1 - EN',
		image: 'template1.gif',
		description: '',
		html: strVar_AA_EN
	},
	{
		title: 'AdHoc Evènement - FR',
		image: 'template1.gif',
		description: '',
		html: strVar_CP_FR
	},
 	]
} );
