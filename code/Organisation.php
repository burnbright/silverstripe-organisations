<?php

class Organisation extends DataObject{
	
	private static $db = array(
		'Name' => 'Varchar',
		//address
		//contact details
	);

	private static $has_one = array(
		'Logo' => 'Image'
	);

	private static $has_many = array(
		'Members' => 'Member'
	);

	private static $default_sort = 'Name ASC';

	public function getOrganisationFormFields(){
		$fields = new FieldList(
			TextField::create("Name", $this->i18n_singular_name()." Name")
		);

		$this->extend('updateOrganisationFormFields', $fields);
		return $fields;
	}

	public function getTitle(){
		return $this->Name;
	}

	public function ProfileLink($action = null) {
		if($directory = OrganisationDirectoryPage::get()->first()){
			return Controller::join_links(
				$directory->Link(),
				'view',
				$this->ID,
				$action
			);
		}
	}

	public function canEdit($member = null){
		if($member && $this->Members()->byID($member->ID)){
			return true;
		}
		return parent::canEdit($member);
	}

}