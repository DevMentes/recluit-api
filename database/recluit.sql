CREATE TABLE "users" (
  "id" varchar,
  "email" varchar,
  "password" varchar
);

CREATE TABLE "applications" (
  "id" varchar,
  "title" varchar,
  "created_by" varchar
);

CREATE TABLE "applicants" (
  "id" varchar,
  "name" varchar,
  "surname" varchar,
  "email" varchar,
  "resume" varchar,
  "application_id" varchar
);

ALTER TABLE "applications" ADD FOREIGN KEY ("created_by") REFERENCES "users" ("id");

ALTER TABLE "applicants" ADD FOREIGN KEY ("application_id") REFERENCES "applications" ("id");