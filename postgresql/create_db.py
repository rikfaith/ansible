#!/usr/bin/env python3
# create_db.py -*-python-*-

import psycopg2

conn = psycopg2.connect(
    host='10.42.93.153',
    database='ts',
    user='ts',
    password='ts.2025'
)

cur = conn.cursor()

cur.execute("""CREATE EXTENSION IF NOT EXISTS timescaledb;""")
conn.commit()

cur.execute('DROP TABLE IF EXISTS env;')
conn.commit()
cur.execute('DROP TABLE IF EXISTS metrics;')
conn.commit()

cur.execute("""
CREATE TABLE IF NOT EXISTS env (
    time TIMESTAMPTZ NOT NULL,
    host TEXT NOT NULL,
    location TEXT,
    labels JSONB,
    metric TEXT NOT NULL,
    units TEXT,
    value FLOAT8 NOT NULL
);
""")
conn.commit()

cur.execute("""
SELECT create_hypertable(
    'env',
    'time',
    if_not_exists => TRUE,
    chunk_time_interval => INTERVAL '7 days');
""")
conn.commit()

cur.execute("""
CREATE TABLE IF NOT EXISTS metrics (
    time TIMESTAMPTZ NOT NULL,
    host TEXT NOT NULL,
    location TEXT,
    labels JSONB,
    metric TEXT NOT NULL,
    units TEXT,
    value FLOAT8 NOT NULL
);
""")
conn.commit()

cur.execute("""
SELECT create_hypertable(
    'metrics',
    'time',
    if_not_exists => TRUE,
    chunk_time_interval => INTERVAL '7 days');
""")
conn.commit()

cur.close()
conn.close()
print("Database and table created successfully.")
