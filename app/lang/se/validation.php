<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => ":attribute måste vara accepterat.",
	"active_url"           => ":attribute är inte en giltlig URL.",
	"after"                => ":attribute måste vara ett datum efter :date.",
	"alpha"                => ":attribute får bara innehålla bokstäver.",
	"alpha_dash"           => ":attribute får bara innehålla bokstäver, siffor och mellanslad.",
	"alpha_num"            => ":attribute får bara innehålla bokstäver och siffror.",
	"array"                => ":attribute måste vara en vektor.",
	"before"               => ":attribute måste vara ett datum före :date.",
	"between"              => array(
		"numeric" => ":attribute måste vara mellan :min och :max.",
		"file"    => ":attribute måste vara mellan :min och :max kilobytes.",
		"string"  => ":attribute måste vara mellan :min och :max tecken.",
		"array"   => ":attribute måste vara mellan :min och :max enheter.",
	),
	"confirmed"            => ":attribute bekräftelse stämmer inte.",
	"date"                 => ":attribute är inte ett giltligt datum.",
	"date_format"          => ":attribute matchar inte formatet :format.",
	"different"            => ":attribute och :other måste skiljas åt.",
	"digits"               => ":attribute måste :digits siffor.",
	"digits_between"       => ":attribute måste vara mellan :min och :max tecken.",
	"email"                => ":attribute måste vara en giltlig email address.",
	"exists"               => "Det valda :attribute är inte giltligt.",
	"image"                => ":attribute måste vara en bild.",
	"in"                   => "Det valda :attribute är ogiltligt.",
	"integer"              => ":attribute måste vara en integer.",
	"ip"                   => ":attribute måste vara en giltlig IP address.",
	"max"                  => array(
		"numeric" => ":attribute måste vara större än :max.",
		"file"    => ":attribute får inte vara större än :max kilobytes.",
		"string"  => ":attribute får inte vara större än :max tecken.",
		"array"   => ":attribute får inte ha mer än :max enheter.",
	),
	"mimes"                => ":attribute måste vara en fil av typen: :values.",
	"min"                  => array(
		"numeric" => ":attribute måste vara minst :min.",
		"file"    => ":attribute måste vara minst :min kilobytes.",
		"string"  => ":attribute måste vara minst :min tecken.",
		"array"   => ":attribute måste ha minst :min enheter.",
	),
	"not_in"               => "Det valda :attribute är inte giltligt.",
	"numeric"              => ":attribute måste vara ett nummer.",
	"regex"                => ":attribute formatet är inte giltligt.",
	"required"             => ":attribute måste fyllas i.",
	"required_if"          => ":attribute måste fyllas i om :other är :value.",
	"required_with"        => ":attribute måste fyllas i om :values är närvarande.",
	"required_with_all"    => ":attribute måste fyllas i när :values är närvarande.",
	"required_without"     => ":attribute måste fyllas i när :values inte är närvarande.",
	"required_without_all" => ":attribute måste fyllas i när ingen av :values är närvarande.",
	"same"                 => ":attribute och :other måste matcha.",
	"size"                 => array(
		"numeric" => ":attribute måste vara :size.",
		"file"    => ":attribute måste vara :size kilobytes.",
		"string"  => ":attribute måste vara :size tecken.",
		"array"   => ":attribute måste innehålla :size enheter.",
	),
	"unique"               => ":attribute har redan blivit tagen.",
	"url"                  => ":attribute format är inte giltligt.",

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(
		'attribute-name' => array(
			'rule-name' => 'custom-message',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(),

);
