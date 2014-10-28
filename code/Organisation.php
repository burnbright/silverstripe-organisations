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
		$this->extend('updateFrontEndFields', $fields);
		$this->extend('updateOrganisationFormFields', $fields);

		$fields->removeByName("AddressHeader");
		
		return $fields;
	}

	public function getTitle(){
		return $this->Name;
	}

	/**
	 * Get the link to the organisation within a directory.
	 * @param string $action
	 * @return string|null
	 */
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

	/**
	 * Content editors can create
	 */
	public function canCreate($member = null) {
		if(Permission::check("CMS_ACCESS_CMSMain")){
			return true;
		}
	}

	/**
	 * Anyone can view
	 */
	public function canView($member = null) {
		return true;
	}

	/**
	 * Content editors and organisation members can edit
	 */
	public function canEdit($member = null){
		if($member && $this->Members()->byID($member->ID)){
			return true;
		}
		if(Permission::check("CMS_ACCESS_CMSMain")){
			return true;
		}
	}

	/**
	 * Content editors can delete
	 */
	public function canDelete($member = null) {
		if(Permission::check("CMS_ACCESS_CMSMain")){
			return true;
		}
	}

}