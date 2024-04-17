<?php
require_once("databaseEntity_class.php");

Class Maintenance extends DatabaseEntity{
    public $maintenance_id, $property_id, $tenant_id, $issue, $cost, $date_made, $date_completed, $iv;
    
}