<?php

class CreateOrganisationForm extends Form
{
    
    
    public function __construct($controller, $name = "CreateOrganisationForm")
    {
        $fields = $this->getOrganisationFields();
        $actions = new FieldList(
            FormAction::create("docreate", "Create")
        );

        $validator = new OrganisationFormValidator(
            'Name'
        );

        parent::__construct($controller, $name, $fields, $actions, $validator);
    }

    public function getOrganisationFields()
    {
        return singleton("Organisation")->getOrganisationFormFields();
    }

    public function docreate($data, $form)
    {
        $organisation = new Organisation();
        $form->saveInto($organisation);
        $organisation->write();

        if ($link = $organisation->getProfileLink('edit')) {
            return $this->controller->redirect($link);
        }
        return $this->controller->redirectBack();
    }
}

class OrganisationFormValidator extends RequiredFields
{

    protected $uniquefield = "Name";

    public function php($data)
    {
        $valid = parent::php($data);

        $uniquefield = $this->uniquefield;

        $organisation = Organisation::get()
            ->filter($uniquefield, $data[$uniquefield])
            ->first();

        if ($uniquefield && is_object($organisation) && $organisation->isInDB()) {
            $uniqueField = $this->form->Fields()->dataFieldByName($uniquefield);
            $this->validationError(
                $uniqueField->id(),
                sprintf(
                    _t(
                        'Member.VALIDATIONORGANISATIONEXISTS',
                        'An organisation already exists with the same %s'
                    ),
                    strtolower($uniquefield)
                ),
                'required'
            );
            $valid = false;
        }

        return $valid;
    }
}
