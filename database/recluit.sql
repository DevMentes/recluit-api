CREATE TABLE "users" (
	"id" varchar(36) NOT NULL,
	"email" varchar(40) NOT NULL UNIQUE,
	"password" varchar(300) NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY ("id")
) WITH (
  OIDS=FALSE
);