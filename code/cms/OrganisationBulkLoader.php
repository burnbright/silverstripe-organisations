<?php

class OrganisationBulkLoader extends CSVBulkLoader
{
    
    public $columnMap = array(
        'Organisation' => 'Name'
    );

    public $duplicateChecks = array(
        'Organisation' => 'Name'
    );
    
    public function __construct($class)
    {
        parent::__construct($class);

        //map fields
        $singular = singleton('Organisation')->singular_name();
        $this->columnMap[$singular] = "Name";
        $this->duplicateChecks[$singular] = "Name";
        $singular = singleton('Organisation')->i18n_singular_name();
        $this->columnMap[$singular] = "Name";
        $this->duplicateChecks[$singular] = "Name";
    }

    protected function processRecord($record, $columnMap, &$results, $preview = false)
    {

        //TODO: skip empties

        $this->extend('preprocess', $record, $columnMap, $results, $preview);
        $id = parent::processRecord($record, $columnMap, $results, $preview);
        if ($org = Organisation::get()->byID($id)) {
            $org->write();
            //callback for doing other custom stuff
            $this->extend('postprocess', $org, $record, $columnMap, $results, $preview);
            $org->destroy();
            unset($org);
        }
        return $id;
    }
}
