<?php

class EditOrganisationForm extends Form{

	protected $organisation;
	
	public function __construct($controller, $name, Organisation $organisation) {
		$this->organisation = $organisation;
		$fields = $this->organisation->getOrganisationFormFields();
		$fields->push(new HiddenField('ID', 'ID', $this->organisation->ID));
		$actions = new FieldList(
			new FormAction('updatedetails', 'Update')
		);
		$validator = new RequiredFields(
			'Name'
		);
		parent::__construct($controller, $name, $fields, $actions, $validator);
		$this->loadDataFrom($this->organisation);
		$this->organisation->extend('updateEditOrganisationForm', $form);
	}

	public function updatedetails($data, $form) {
		$form->saveInto($this->organisation);
		$this->organisation->write();
		$form->sessionMessage("Changes have been saved", "good");
		return $this->controller->redirectBack();
	}

}