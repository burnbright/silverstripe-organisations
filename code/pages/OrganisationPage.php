<?php

class OrganisationPage extends Page{

	private static $has_one = array(
		'Organisation' => 'Organisation'
	);

	/**
	 * Allow viewing draft site when page is fake.
	 */
	public function canViewStage($stage = 'Live', $member = null) {
		return ($this->ID == -1) ? true : parent::canViewStage($stage, $member);
	}

}

class OrganisationPage_Controller extends Page_Controller{

	public static $allowed_actions = array(
		'edit'
	);

	function edit(){
		return array(
			'Title' => 'Editing '.$this->Title
		);
	}

}