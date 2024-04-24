<?php ///File to delete and populate database, do it this side so encryption can work.
require_once('../php_classes/account_class.php');
require_once('../php_classes/address_class.php');
require_once('../php_classes/amenity_class.php');
require_once('../php_classes/cost_class.php');
require_once('../php_classes/document_class.php');
require_once('../php_classes/lease_class.php');
require_once('../php_classes/maintenance_class.php');
require_once('../php_classes/message_class.php');
require_once('../php_classes/notification_class.php');
require_once('../php_classes/occupancy_class.php');
require_once('../php_classes/onetime_code_class.php');
require_once('../php_classes/property_class.php');
require_once('../php_classes/service_provider_class.php');

///Checks if there is a documents folder and deletes it and contents before creating a new one.


$dir = '../storage/documents/';



if (file_exists($dir)) {
    $files = array_diff(scandir($dir), array('.', '..'));
    foreach ($files as $file) {
        if(!unlink("$dir/$file")){
            echo 'Failed to delete '.$file.'<br>';
            exit;
        } else if(unlink("$dir/$file")){
            echo 'Successfully deleted '.$file.'<br>';
        }
    }
    if(!rmdir($dir)){
        echo 'Failed to delete directory<br>';
        exit;
    }  
}

if (!mkdir($dir, 0777, true)) {
    echo "Failed to create the folder.<br>";
    exit;
}
else
{
    echo "Folder created successfully.<br>";
}



///New database file
$newFile = '../storage/database.db';

if (file_exists($newFile)) {
    if (unlink($newFile)) {
        echo "Existing database file deleted successfully.<br>";
    } else {
        echo "Error deleting existing database file.<br>";
    }
}

$db = new SQLite3($newFile);
if ($db) {
    echo "New database file created successfully.<br>";    
    $sqlFile = '../create_tables.sql';
    
    if (file_exists($sqlFile)) {///creates database tables
        $sqlQueries = file_get_contents($sqlFile);        
        if ($db->exec($sqlQueries)) {
            echo "Tables created successfully.<br>";
        } else {
            echo "Error executing SQL queries.<br>";
        }
    } else {
        echo "SQL script file not found.<br>";
    }
} else {
    echo "Error creating new database file.<br>";
}

/// Specify the file path for the keys.json file
$keysFile = '../storage/keys.json';

if (file_exists($keysFile)) {
    if (unlink($keysFile)) {
        echo "Existing keys.json file deleted successfully.<br>";
    } else {
        echo "Error deleting existing keys.json file.<br>";
    }
}

// Create a new keys.json file and populate it with data
$keysData = '{
    "Accounts":"c8a2a2b0897",
    "Onetime_codes":"hgi4y8thi3eht",
    "Properties":"9483jib7reyufgintyf7ve",
    "Addresses":"i09ijo79u",
    "Costs":"t43tg45rhrtj",
    "Amenities":"ue28ur8o38",
    "Tenants":"vvvvvvbfndjkjeti4",
    "Landlords":"jrbb4i4r9ewnffdi294t",
    "Documents":"ynv6b79m5v7v",
    "Notification":"iwhbytbdta2123",
    "Service_providers": "adadwaerr123",
    "Lease":"asdq3nmp3",
    "Occupancies":"asdq213jpi0",
    "Maintenance_Requests":"binjqug8y21",
    "static_iv":"usernameusername"
}';

// Write data to the keys.json file
if (file_put_contents($keysFile, $keysData)) {
    echo "keys.json file created and populated successfully.<br>";
} else {
    echo "Error creating keys.json file.<br>";
}
///users
$users = array(
    array(
        'username' => 'nimda',
        'fname' => 'Adam',
        'lname' => 'Minor',
        'email' => 'AdMajor@wherever.com',
        'password' => 'Hologram',
        'account_type' => 'admin'
    ),
    array(
        'username' => 'lubber',
        'fname' => 'Ed',
        'lname' => 'Thatch',
        'email' => 'jollyRoger@blackflags.com',
        'password' => 'dubloons',
        'account_type' => 'landlord'
    ),
    array(
        'username' => 'decibel',
        'fname' => 'David',
        'lname' => 'Hess',
        'email' => 'goldstar@hollblvd.com',
        'password' => 'oscars',
        'account_type' => 'tenant'
    ),
    array(
        'username' => 'unvert',
        'fname' => 'Vernon',
        'lname' => 'Dursley',
        'email' => 'privet@drive.com',
        'password' => 'potter',
        'account_type' => 'tenant'
    ),
    array(
        'username' => 'mrsmith',
        'fname' => 'John',
        'lname' => 'Smith',
        'email' => 'johnsmith@example.com',
        'password' => 'password123',
        'account_type' => 'landlord'
    ),
    array(
        'username' => 'mrsjones',
        'fname' => 'Emily',
        'lname' => 'Jones',
        'email' => 'emilyjones@example.com',
        'password' => 'password456',
        'account_type' => 'landlord'
    ),
    array(
        'username' => 'harrypotter',
        'fname' => 'Harry',
        'lname' => 'Potter',
        'email' => 'harrypotter@example.com',
        'password' => 'gryffindor',
        'account_type' => 'tenant'
    ),
    array(
        'username' => 'ronweasley',
        'fname' => 'Ron',
        'lname' => 'Weasley',
        'email' => 'ronweasley@example.com',
        'password' => 'weasley',
        'account_type' => 'tenant'
    ),
    array(
        'username' => 'hermionegranger',
        'fname' => 'Hermione',
        'lname' => 'Granger',
        'email' => 'hermionegranger@example.com',
        'password' => 'library',
        'account_type' => 'tenant'
    )
);

for ($i = 0; $i < count($users); $i++) {
    echo "Processing user: " . print_r($users[$i], true) . "<br>";
    $account = new Account($users[$i]);
    $result = $account->createAccount();
    echo "Result: " . ($result ? "Success" : "Failure") . "<br>";
    if($i<6){
        $result = $account->verifyAccount();
        echo "Verified?: " . ($result ? "Success" : "Failure") . "<br>";
    }
}
///populate Properties
$propertyData = array(
    array(
        'landlord_id' => 1,
        'title' => 'Toad Hall',
        'square_footage' => 15000,
        'bedrooms' => 4,
        'bathrooms' => 5,
        'deposit' => 200000,
        'description' => 'Its not a swamp, its a feature.',
        'verified' => 1
    ),
    array(
        'landlord_id' => 2,
        'title' => 'Cherry Cottage',
        'square_footage' => 12000,
        'bedrooms' => 3,
        'bathrooms' => 2,
        'deposit' => 150000,
        'description' => 'Quaint and cozy with a garden view.',
        'verified' => 1
    ),
    array(
        'landlord_id' => 3,
        'title' => 'Baker Mansion',
        'square_footage' => 18000,
        'bedrooms' => 5,
        'bathrooms' => 4,
        'deposit' => 300000,
        'description' => 'Mysterious and spacious, with a study.',
        'verified' => 1
    ),
    array(
        'landlord_id' => 3,
        'title' => 'Riverside Retreat',
        'square_footage' => 16000,
        'bedrooms' => 4,
        'bathrooms' => 3,
        'deposit' => 250000,
        'description' => 'Tranquil retreat with a view of the river.',
        'verified' => 0
    ),
    array(
        'landlord_id' => 1,
        'title' => 'Mountain Lodge',
        'square_footage' => 18000,
        'bedrooms' => 5,
        'bathrooms' => 3,
        'deposit' => 280000,
        'description' => 'A cozy lodge nestled in the mountains.',
        'verified' => 1
    )
);

$addressData = array(
    array(
        'post_code' => 'SW1A 1AA',
        'street_address' => '10 Willow Lane',
        'county' => 'Acreage',
        'door_number' => '2b'
    ),
    array(
        'post_code' => 'E1 6AN',
        'street_address' => '12 Cherry Tree Lane',
        'county' => 'Kensington',
        'door_number' => '17'
    ),
    array(
        'post_code' => 'W1A 1AA',
        'street_address' => '221B Baker Street',
        'county' => 'Westminster',
        'door_number' => '221b'
    ),
    array(
        'post_code' => 'WC1X 9PX',
        'street_address' => '8 Riverside Road',
        'county' => 'Bristol',
        'door_number' => '8'
    ),
    array(
        'post_code' => 'LL65 1AB',
        'street_address' => '20 Mountain View Drive',
        'county' => 'Conwy',
        'door_number' => '20'
    )
);

$costData = array(
    array(
        'cost' => 25000,
        'duration' => 2,
        'period' => 'months'
    ),
    array(
        'cost' => 6000,
        'duration' => 3,
        'period' => 'weeks'
    ),
    array(
        'cost' => 80000,
        'duration' => 1,
        'period' => 'years'
    ),
    array(
        'cost' => 20000,
        'duration' => 5,
        'period' => 'months'
    ),
    array(
        'cost' => 32000,
        'duration' => 7,
        'period' => 'months'
    )
);

$amenityData = array(
    array(
        array('description' => 'Pool')
    ),
    array(
        array('description' => 'Garden')
    ),
    array(
        array('description' => 'Study Room'),
        array('description' => 'Attic')
    ),
    array(
        array('description' => 'River View')
    ),
    array(
        array('description' => 'Sauna'),
        array('description' => 'Hiking Trails')
    )
);

for ($i = 0; $i < count($propertyData); $i++) {

    $address = new Address($addressData[$i]);
    $address->createAddress();

    $property = new Property(array_merge($propertyData[$i], ['address_id' => $address->address_id]));
    $property->createProperty();

    $cost = new Cost(array_merge($costData[$i], ['property_id' => $property->property_id]));
    $cost->createCost();

    foreach ($amenityData[$i] as $amenity) {
        $newAmenity = new Amenity(array_merge($amenity, ['property_id' => $property->property_id]));
        $newAmenity->createAmenity();
    }
}

$serviceArray = array(
    array(
        'landlord_id' => 1,
        'name' => "Maria's Maids",
        'email' => "M&M@hotmail.com",
        'phone' => "01234567822"
    ),
    array(
        'landlord_id' => 2,
        'name' => "Bob's Butlers",
        'email' => "bob@example.com",
        'phone' => "9876543210"
    ),
    array(
        'landlord_id' => 3,
        'name' => "Charlie's Cleaners",
        'email' => "charlie@example.com",
        'phone' => "5555555555"
    ),
    array(
        'landlord_id' => 1,
        'name' => "Lucy's Laundry",
        'email' => "lucy@example.com",
        'phone' => "1234567890"
    ),
    array(
        'landlord_id' => 2,
        'name' => "Dave's Dusting",
        'email' => "dave@example.com",
        'phone' => "5551234567"
    )
);

for ($i = 0; $i < count($serviceArray); $i++) {
    $serviceData = $serviceArray[$i];
    $service = new ServiceProvider($serviceData);
    $sResult = $service->createService();

    if ($sResult) {
        echo ($i+1)." successfully made!<br>";
    } else {
        echo "Failed to create service $i<br>";
    }
}

//Lease and occupancy

/*
$FP = '../storage/sample/';
$images = array_diff(scandir($FP), array('.', '..'));
$images = array_values($images);

var_dump($images);*/

