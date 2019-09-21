CREATE TABLE "users" (
  "id" varchar,
  "email" varchar,
  "password" varchar
);

CREATE TABLE "postulations" (
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
  "postulation_id" varchar
);

ALTER TABLE "postulations" ADD FOREIGN KEY ("created_by") REFERENCES "users" ("id");

ALTER TABLE "applicants" ADD FOREIGN KEY ("postulation_id") REFERENCES "postulations" ("id");