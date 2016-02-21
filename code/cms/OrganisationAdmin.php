<?php

class OrganisationAdmin extends ModelAdmin
{

    private static $url_segment = "organisations";
    private static $menu_title = "Organisations";
    private static $menu_icon = 'organisations/images/building-icon.png';

    private static $managed_models = array(
        'Organisation'
    );

    private static $model_importers = array(
        'Organisation' => 'OrganisationBulkLoader'
    );
}
