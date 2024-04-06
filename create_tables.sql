CREATE TABLE "Accounts" (
	"account_id"	INTEGER,
	"username"	TEXT UNIQUE,
	"fname"	TEXT,
	"lname"	TEXT,
	"email"	TEXT,
	"password"	TEXT,
	"account_type"	TEXT,
	"verified"	INTEGER,
	"iv"	TEXT,
	PRIMARY KEY("account_id" AUTOINCREMENT)
);

CREATE TABLE "Tenants" (
	"tenant_id"	INTEGER,
	"account_id"	INTEGER,
	PRIMARY KEY("tenant_id" AUTOINCREMENT),
	FOREIGN KEY("account_id") REFERENCES "Accounts"("account_id")
);

CREATE TABLE "Landlords" (
	"landlord_id"	INTEGER,
	"account_id"	INTEGER,
	PRIMARY KEY("landlord_id" AUTOINCREMENT),
	FOREIGN KEY("account_id") REFERENCES "Accounts"("account_id")
);

CREATE TABLE "Onetime_codes" (
	"code_id"	INTEGER,
	"account_id"	TEXT,
	"code"	TEXT,
	"iv"	TEXT,
	PRIMARY KEY("code_id" AUTOINCREMENT)
);

CREATE TABLE "Addresses" (
	"address_id"	INTEGER,
	"post_code"	TEXT,
	"street_address"	TEXT,
	"county"	TEXT,
	"door_number"	TEXT,
	PRIMARY KEY("address_id" AUTOINCREMENT)
);

CREATE TABLE "Properties" (
	"property_id"	INTEGER,
	"landlord_id"	TEXT,
	"address_id"	TEXT,
	"square_footage"	INTEGER,
	"bedrooms"	INTEGER,
	"bathrooms"	INTEGER,
	"deposit"	INTEGER,
	"verified"	INTEGER DEFAULT 0,
	"description"	TEXT,
	"iv"	TEXT,
	PRIMARY KEY("property_id" AUTOINCREMENT)
);

CREATE TABLE "Amenities" (
	"amenity_id"	INTEGER,
	"property_id"	INTEGER,
	"description"	TEXT,
	PRIMARY KEY("amenity_id" AUTOINCREMENT),
	FOREIGN KEY("property_id") REFERENCES "Properties"("property_id")
);

CREATE TABLE "Costs" (
	"cost_id"	INTEGER,
	"property_id"	INTEGER,
	"cost"	INTEGER,
	"duration"	INTEGER,
	PRIMARY KEY("cost_id" AUTOINCREMENT),
	FOREIGN KEY("property_id") REFERENCES "Properties"("property_id")
);

CREATE TABLE "Documents" (
	"document_id"	INTEGER,
	"property_id"	INTEGER,
	"account_id"	INTEGER,
	"document_type"	TEXT,
	"name"	TEXT,
	"mime_type"	TEXT,
	"upload_datetime"	DATETIME,
	PRIMARY KEY("document_id" AUTOINCREMENT),
	FOREIGN KEY("property_id") REFERENCES "Properties"("property_id"),
	FOREIGN KEY("account_id") REFERENCES "Accounts"("account_id")
);

CREATE TABLE "Service_providers" (
	"service_id"	INTEGER,
	"landlord_id"	INTEGER,
	"name"	TEXT,
	"email"	TEXT,
	PRIMARY KEY("service_id" AUTOINCREMENT),
	FOREIGN KEY("landlord_id") REFERENCES "Landlords"("landlord_id")
);

CREATE TABLE "Message_rooms" (
	"room_id"	INTEGER,
	PRIMARY KEY("room_id" AUTOINCREMENT)
);

CREATE TABLE "Direct_messages" (
	"message_id"	INTEGER,
	"room_id"	INTEGER,
	"account_id"	TEXT,
	"content"	TEXT,
	"send_datetime"	DATETIME,
	"iv"	TEXT,
	PRIMARY KEY("message_id" AUTOINCREMENT),
	FOREIGN KEY("room_id")	REFERENCES "Message_rooms"("room_id")
);

CREATE TABLE "Room_participants" (
	"room_id"	INTEGER,
	"account_id"	INTEGER,
	"join_datetime"	DATETIME,
	FOREIGN KEY("room_id") REFERENCES "Message_rooms"("room_id"),
	FOREIGN KEY("account_id") REFERENCES "Accounts"("account_id"),
	PRIMARY KEY("room_id","account_id")
);