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

CREATE TABLE "Onetime_codes" (
	"code_id"	INTEGER,
	"account_id"	TEXT,
	"code"	TEXT,
	"iv"	TEXT,
	PRIMARY KEY("code_id")
);