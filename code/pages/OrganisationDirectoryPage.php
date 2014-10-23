<?php

class OrganisationDirectoryPage extends Page{

}

class OrganisationDirectoryPage_Controller extends Page_Controller{

	private static $allowed_actions = array(
		'view' => true
	);
	
	function getOrganisations(){
		return Organisation::get();
	}

	function view() {
		if($organisation = $this->getOrganisationFromRequest()) {
			//shift the request params
			$this->request->shiftAllParams();
			$this->request->shift();
			$record = new OrganisationPage(array(
				'ID' => -1,
				'Title' => $organisation->Title,
				'Content' => '',
				'ParentID' => $this->ID,
				'OrganisationID' => $organisation->ID,
				'URLSegment' => 'view/'.$organisation->ID
			));
			return new OrganisationPage_Controller($record);
		}
		$this->httpError(404);
	}

	protected function getOrganisationFromRequest(){
		return Organisation::get()->byID(
			(int)$this->request->param('ID')
		);
	}

}