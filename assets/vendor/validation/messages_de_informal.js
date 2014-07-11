/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: DE (German, Deutsch)
 */
(function ($) {
	$.extend($.validator.messages, {
		required: "Dieses Feld ist ein Pflichtfeld.",
		maxlength: $.validator.format("Bitte gib maximal {0} Zeichen ein."),
		minlength: $.validator.format("Bitte gib mindestens {0} Zeichen ein."),
		rangelength: $.validator.format("Bitte gib bitte mindestens {0} und maximal {1} Zeichen ein."),
		email: "Bitte gib eine gültige E-Mail Adresse ein.",
		url: "Bitte gib eine gültige URL ein.",
		date: "Bitte gib ein gültiges Datum ein.",
		number: "Bitte gib eine Nummer ein.",
		digits: "Bitte gib nur Ziffern ein.",
		equalTo: "Bitte denselben Wert wiederholen.",
		range: $.validator.format("Bitte gib einen Wert zwischen {0} und {1} ein."),
		max: $.validator.format("Bitte gib einen Wert kleiner oder gleich {0} ein."),
		min: $.validator.format("Bitte gib einen Wert größer oder gleich {0} ein."),
		creditcard: "Bitte gib eine gültige Kreditkarten-Nummer ein."
	});
}(jQuery));