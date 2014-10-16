<?php

class OrganisationAdmin extends ModelAdmin{

	private static $url_segment = "organisations";
	private static $menu_title = "Organisations";

	private static $managed_models = array(
		'Organisation'
	);

	private static $model_importers = array(
		'Organisation' => 'OrganisationBulkLoader'
	);

}