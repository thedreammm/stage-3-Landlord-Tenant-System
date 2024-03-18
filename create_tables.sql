CREATE TABLE "Accounts" (
	"account_id"	INTEGER,
	"username"	TEXT UNIQUE,
	"fname"	TEXT,
	"lname"	TEXT,
	"email"	TEXT,
	"password"	TEXT,
	"account_type"	TEXT,
	"iv"	TEXT,
	PRIMARY KEY("account_id" AUTOINCREMENT)
);