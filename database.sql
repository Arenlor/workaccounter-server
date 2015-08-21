CREATE TABLE users (
    username character varying NOT NULL,
    password character varying(128) NOT NULL,
    apikey character varying NOT NULL,
    count bigint DEFAULT 0 NOT NULL
);
ALTER TABLE ONLY users ADD CONSTRAINT users_apikey_key UNIQUE (apikey);
ALTER TABLE ONLY users ADD CONSTRAINT users_pkey PRIMARY KEY (username);