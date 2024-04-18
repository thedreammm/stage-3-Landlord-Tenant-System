<?php require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/service_provider_class.php');
require_once('../php_classes/account_class.php');

if(isset($_GET['mid'])){
    $maintenance1 = Maintenance::GetRequestByID($_GET['mid']);

    $property1 = new Property(false);
    $property1->property_id = $maintenance1->property_id;
    $property1->loadProperty();

    $landlord_id = $_SESSION['landlord_id'];
    $service_providers = loadServiceProviders($landlord_id);

    $tenant1 = new Tenant(false);
    $tenant1->tenant_id = $maintenance1->tenant_id;
    $tenant1->GetAccountFromTID();


}

if(isset($_POST['Submit1'])){
    $maintenance1 = Maintenance::GetRequestByID($_POST['mid']);
    $maintenance1->service_id = $_POST['service_id'];
    $maintenance1->date_service = $_POST['date_service'];
    $maintenance1->SetService();
    Header('Location = view_leases.php');
} else if(isset($_POST['Submit2'])){
    $maintenance1 = Maintenance::GetRequestByID($_POST['mid']);
    $maintenance1->cost = $_POST['cost'];
    $maintenance1->date_completed = $_POST['date_completed'];
    $maintenance1->MarkComplete();
    Header('Location = view_leases.php');
}

?>