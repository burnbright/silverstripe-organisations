<?php

class OrganisationPage extends Page
{

    private static $has_one = array(
        'Organisation' => 'Organisation'
    );

    /**
     * Allow viewing draft site when page is fake.
     */
    public function canViewStage($stage = 'Live', $member = null)
    {
        return ($this->ID == -1) ? true : parent::canViewStage($stage, $member);
    }
}

class OrganisationPage_Controller extends Page_Controller
{

    public static $allowed_actions = array(
        'edit' => true,
        'EditOrganisationForm' => '->canEditOrganisation'
    );

    public function edit()
    {
        if (!$this->canEditOrganisation()) {
            return Security::permissionFailure($this,
                "You do not have permission to edit this organisation."
            );
        }

        return array(
            'Title' => 'Editing '.$this->Title,
            'Form' => $this->EditOrganisationForm()
        );
    }

    public function EditOrganisationForm()
    {
        return new EditOrganisationForm($this, "EditOrganisationForm", $this->Organisation());
    }

    public function canEditOrganisation()
    {
        return $this->Organisation()->canEdit(Member::currentUser());
    }
}
