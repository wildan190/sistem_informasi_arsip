-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS activity_log_id_seq;

-- Table Definition
CREATE TABLE "public"."activity_log" (
    "id" int8 NOT NULL DEFAULT nextval('activity_log_id_seq'::regclass),
    "log_name" varchar(255),
    "description" text NOT NULL,
    "subject_type" varchar(255),
    "subject_id" int8,
    "causer_type" varchar(255),
    "causer_id" int8,
    "properties" json,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "event" varchar(255),
    "batch_uuid" uuid,
    PRIMARY KEY ("id")
);


-- Indices
CREATE INDEX subject ON public.activity_log USING btree (subject_type, subject_id)
CREATE INDEX causer ON public.activity_log USING btree (causer_type, causer_id)
CREATE INDEX activity_log_log_name_index ON public.activity_log USING btree (log_name);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."arsips" (
    "id" uuid NOT NULL,
    "title" varchar(255) NOT NULL,
    "content" text NOT NULL,
    "attachment" varchar(255),
    "category_id" uuid NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" date,
    CONSTRAINT "arsips_category_id_foreign" FOREIGN KEY ("category_id") REFERENCES "public"."categories"("id"),
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."cache" (
    "key" varchar(255) NOT NULL,
    "value" text NOT NULL,
    "expiration" int4 NOT NULL,
    PRIMARY KEY ("key")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."cache_locks" (
    "key" varchar(255) NOT NULL,
    "owner" varchar(255) NOT NULL,
    "expiration" int4 NOT NULL,
    PRIMARY KEY ("key")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."categories" (
    "id" uuid NOT NULL,
    "name" varchar(255) NOT NULL,
    "description" varchar(255),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" date,
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS failed_jobs_id_seq;

-- Table Definition
CREATE TABLE "public"."failed_jobs" (
    "id" int8 NOT NULL DEFAULT nextval('failed_jobs_id_seq'::regclass),
    "uuid" varchar(255) NOT NULL,
    "connection" text NOT NULL,
    "queue" text NOT NULL,
    "payload" text NOT NULL,
    "exception" text NOT NULL,
    "failed_at" timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX failed_jobs_uuid_unique ON public.failed_jobs USING btree (uuid);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."job_batches" (
    "id" varchar(255) NOT NULL,
    "name" varchar(255) NOT NULL,
    "total_jobs" int4 NOT NULL,
    "pending_jobs" int4 NOT NULL,
    "failed_jobs" int4 NOT NULL,
    "failed_job_ids" text NOT NULL,
    "options" text,
    "cancelled_at" int4,
    "created_at" int4 NOT NULL,
    "finished_at" int4,
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS jobs_id_seq;

-- Table Definition
CREATE TABLE "public"."jobs" (
    "id" int8 NOT NULL DEFAULT nextval('jobs_id_seq'::regclass),
    "queue" varchar(255) NOT NULL,
    "payload" text NOT NULL,
    "attempts" int2 NOT NULL,
    "reserved_at" int4,
    "available_at" int4 NOT NULL,
    "created_at" int4 NOT NULL,
    PRIMARY KEY ("id")
);


-- Indices
CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS logs_id_seq;

-- Table Definition
CREATE TABLE "public"."logs" (
    "id" int8 NOT NULL DEFAULT nextval('logs_id_seq'::regclass),
    "user_id" int8 NOT NULL,
    "action" varchar(255) NOT NULL,
    "details" text,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    CONSTRAINT "logs_user_id_foreign" FOREIGN KEY ("user_id") REFERENCES "public"."users"("id") ON DELETE CASCADE,
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS migrations_id_seq;

-- Table Definition
CREATE TABLE "public"."migrations" (
    "id" int4 NOT NULL DEFAULT nextval('migrations_id_seq'::regclass),
    "migration" varchar(255) NOT NULL,
    "batch" int4 NOT NULL,
    PRIMARY KEY ("id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."model_has_permissions" (
    "permission_id" int8 NOT NULL,
    "model_type" varchar(255) NOT NULL,
    "model_id" int8 NOT NULL,
    CONSTRAINT "model_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "public"."permissions"("id") ON DELETE CASCADE,
    PRIMARY KEY ("permission_id","model_id","model_type")
);


-- Indices
CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."model_has_roles" (
    "role_id" int8 NOT NULL,
    "model_type" varchar(255) NOT NULL,
    "model_id" int8 NOT NULL,
    CONSTRAINT "model_has_roles_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "public"."roles"("id") ON DELETE CASCADE,
    PRIMARY KEY ("role_id","model_id","model_type")
);


-- Indices
CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."notifications" (
    "id" uuid NOT NULL,
    "type" varchar(255) NOT NULL,
    "notifiable_type" varchar(255) NOT NULL,
    "notifiable_id" int8 NOT NULL,
    "data" text NOT NULL,
    "read_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);


-- Indices
CREATE INDEX notifications_notifiable_type_notifiable_id_index ON public.notifications USING btree (notifiable_type, notifiable_id);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."password_reset_tokens" (
    "email" varchar(255) NOT NULL,
    "token" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    PRIMARY KEY ("email")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS permissions_id_seq;

-- Table Definition
CREATE TABLE "public"."permissions" (
    "id" int8 NOT NULL DEFAULT nextval('permissions_id_seq'::regclass),
    "name" varchar(255) NOT NULL,
    "guard_name" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX permissions_name_guard_name_unique ON public.permissions USING btree (name, guard_name);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS personal_access_tokens_id_seq;

-- Table Definition
CREATE TABLE "public"."personal_access_tokens" (
    "id" int8 NOT NULL DEFAULT nextval('personal_access_tokens_id_seq'::regclass),
    "tokenable_type" varchar(255) NOT NULL,
    "tokenable_id" int8 NOT NULL,
    "name" varchar(255) NOT NULL,
    "token" varchar(64) NOT NULL,
    "abilities" text,
    "last_used_at" timestamp(0),
    "expires_at" timestamp(0),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);


-- Indices
CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id)
CREATE UNIQUE INDEX personal_access_tokens_token_unique ON public.personal_access_tokens USING btree (token);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."role_has_permissions" (
    "permission_id" int8 NOT NULL,
    "role_id" int8 NOT NULL,
    CONSTRAINT "role_has_permissions_permission_id_foreign" FOREIGN KEY ("permission_id") REFERENCES "public"."permissions"("id") ON DELETE CASCADE,
    CONSTRAINT "role_has_permissions_role_id_foreign" FOREIGN KEY ("role_id") REFERENCES "public"."roles"("id") ON DELETE CASCADE,
    PRIMARY KEY ("permission_id","role_id")
);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS roles_id_seq;

-- Table Definition
CREATE TABLE "public"."roles" (
    "id" int8 NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
    "name" varchar(255) NOT NULL,
    "guard_name" varchar(255) NOT NULL,
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX roles_name_guard_name_unique ON public.roles USING btree (name, guard_name);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Table Definition
CREATE TABLE "public"."sessions" (
    "id" varchar(255) NOT NULL,
    "user_id" int8,
    "ip_address" varchar(45),
    "user_agent" text,
    "payload" text NOT NULL,
    "last_activity" int4 NOT NULL,
    PRIMARY KEY ("id")
);


-- Indices
CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id)
CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);

-- This script only contains the table creation statements and does not fully represent the table in the database. Do not use it as a backup.

-- Sequence and defined type
CREATE SEQUENCE IF NOT EXISTS users_id_seq;

-- Table Definition
CREATE TABLE "public"."users" (
    "id" int8 NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    "name" varchar(255) NOT NULL,
    "email" varchar(255) NOT NULL,
    "email_verified_at" timestamp(0),
    "password" varchar(255) NOT NULL,
    "remember_token" varchar(100),
    "created_at" timestamp(0),
    "updated_at" timestamp(0),
    "deleted_at" date,
    PRIMARY KEY ("id")
);


-- Indices
CREATE UNIQUE INDEX users_email_unique ON public.users USING btree (email);





INSERT INTO "public"."cache" ("key", "value", "expiration") VALUES
('spatie.permission.cache', 'a:3:{s:5:"alias";a:4:{s:1:"a";s:2:"id";s:1:"b";s:4:"name";s:1:"c";s:10:"guard_name";s:1:"r";s:5:"roles";}s:11:"permissions";a:4:{i:0;a:4:{s:1:"a";i:1;s:1:"b";s:4:"Edit";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:1;a:4:{s:1:"a";i:2;s:1:"b";s:6:"Delete";s:1:"c";s:3:"web";s:1:"r";a:1:{i:0;i:1;}}i:2;a:4:{s:1:"a";i:3;s:1:"b";s:6:"Create";s:1:"c";s:3:"web";s:1:"r";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:3;a:4:{s:1:"a";i:4;s:1:"b";s:6:"Assign";s:1:"c";s:3:"web";s:1:"r";a:2:{i:0;i:1;i:1;i:3;}}}s:5:"roles";a:3:{i:0;a:3:{s:1:"a";i:1;s:1:"b";s:5:"Admin";s:1:"c";s:3:"web";}i:1;a:3:{s:1:"a";i:2;s:1:"b";s:8:"Employee";s:1:"c";s:3:"web";}i:2;a:3:{s:1:"a";i:3;s:1:"b";s:6:"Leader";s:1:"c";s:3:"web";}}}', 1723455558);












INSERT INTO "public"."logs" ("id", "user_id", "action", "details", "created_at", "updated_at") VALUES
(1, 1, 'create', 'Created user: Admin', '2024-08-11 09:38:40', '2024-08-11 09:38:40');
INSERT INTO "public"."logs" ("id", "user_id", "action", "details", "created_at", "updated_at") VALUES
(2, 1, 'create', 'Created role: Admin', '2024-08-11 09:39:00', '2024-08-11 09:39:00');
INSERT INTO "public"."logs" ("id", "user_id", "action", "details", "created_at", "updated_at") VALUES
(3, 1, 'create', 'Created role: Employee', '2024-08-11 09:39:09', '2024-08-11 09:39:09');
INSERT INTO "public"."logs" ("id", "user_id", "action", "details", "created_at", "updated_at") VALUES
(4, 1, 'create', 'Created role: Leader', '2024-08-11 09:39:18', '2024-08-11 09:39:18');

INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES
(25, '0001_01_01_000000_create_users_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES
(26, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES
(27, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO "public"."migrations" ("id", "migration", "batch") VALUES
(28, '2024_08_09_125439_create_personal_access_tokens_table', 1),
(29, '2024_08_09_163810_create_permission_tables', 1),
(30, '2024_08_09_163811_create_activity_log_table', 1),
(31, '2024_08_09_163812_add_event_column_to_activity_log_table', 1),
(32, '2024_08_09_163813_add_batch_uuid_column_to_activity_log_table', 1),
(33, '2024_08_09_190552_create_categories_table', 1),
(34, '2024_08_09_193014_create_arsips_table', 1),
(35, '2024_08_10_083936_create_logs_table', 1),
(36, '2024_08_10_085822_create_notifications_table', 1);



INSERT INTO "public"."model_has_roles" ("role_id", "model_type", "model_id") VALUES
(1, 'App\Models\User', 1);


INSERT INTO "public"."notifications" ("id", "type", "notifiable_type", "notifiable_id", "data", "read_at", "created_at", "updated_at") VALUES
('0d6b9368-5c17-4e05-9e3b-3995351fc0a8', 'App\Notifications\UserActionNotification', 'App\Models\User', 1, '{"action":"updated","details":"Updated user: Admin","user_id":1}', NULL, '2024-08-11 09:38:40', '2024-08-11 09:38:40');




INSERT INTO "public"."permissions" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(1, 'Edit', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');
INSERT INTO "public"."permissions" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(2, 'Delete', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');
INSERT INTO "public"."permissions" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(3, 'Create', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');
INSERT INTO "public"."permissions" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(4, 'Assign', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');



INSERT INTO "public"."role_has_permissions" ("permission_id", "role_id") VALUES
(1, 1);
INSERT INTO "public"."role_has_permissions" ("permission_id", "role_id") VALUES
(2, 1);
INSERT INTO "public"."role_has_permissions" ("permission_id", "role_id") VALUES
(3, 1);
INSERT INTO "public"."role_has_permissions" ("permission_id", "role_id") VALUES
(4, 1),
(1, 2),
(3, 2),
(1, 3),
(3, 3),
(4, 3);

INSERT INTO "public"."roles" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(1, 'Admin', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');
INSERT INTO "public"."roles" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(2, 'Employee', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');
INSERT INTO "public"."roles" ("id", "name", "guard_name", "created_at", "updated_at") VALUES
(3, 'Leader', 'web', '2024-08-11 09:30:15', '2024-08-11 09:30:15');

INSERT INTO "public"."sessions" ("id", "user_id", "ip_address", "user_agent", "payload", "last_activity") VALUES
('OW1Tl1qTfKfP0VizZkiAQWS4p172moO47oLD88Gi', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUTJuR2VlU09nUkVVNlN1T0JkRUtaYXBtTUhObHpKQjFhTXVKR292ViI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo1NDoiaHR0cDovL3Npc3RlbV9pbmZvcm1hc2lfYXJzaXAudGVzdC9jbXMvcGFnZXMvZGFzaGJvYXJkIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTA6Imh0dHA6Ly9zaXN0ZW1faW5mb3JtYXNpX2Fyc2lwLnRlc3QvY21zL3BhZ2VzL3VzZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1723369190);


INSERT INTO "public"."users" ("id", "name", "email", "email_verified_at", "password", "remember_token", "created_at", "updated_at", "deleted_at") VALUES
(1, 'Admin', 'admin@dev.com', '2024-08-11 16:31:17', '$2y$12$WTA24X9Ga5psVl41eH1jweX2sZaJHz0xjauuSlLlXSXYlY3hW9YrG', NULL, '2024-08-11 09:30:57', '2024-08-11 09:30:57', NULL);

