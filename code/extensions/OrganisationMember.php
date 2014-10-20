<?php

class OrganisationMember extends DataExtension{
	
	public static $has_one = array(
		'Organisation' => 'Organisation'
	);

	function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root.Main",
			DropdownField::create("OrganisationID","Organisation",
				Organisation::get()
					->filter("Name:not", "")
					->map()
					->toArray()
			)->setHasEmptyDefault(true)
		);
	}

}