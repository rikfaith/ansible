#!/usr/bin/env python3
# gather.py -*-python-*-

import re
import json
import requests
import psycopg2
import time

class GatherEcowitt():
    def __init__(self, host='timescale', database='ts', user='ts',
                 password='ts.2025'):
        self.conn = psycopg2.connect(
            host=host,
            database=database,
            user=user,
            password=password
        )

    def insert_data(self, timestamp, location, metric, units, value):
        with self.conn.cursor() as cur:
            cur.execute("""
                INSERT INTO env (timestamp, location, metric, units, value)
                VALUES (%s, %s, %s, %s, %s);
            """, (timestamp, location, metric, units, value))
            self.conn.commit()

    def close(self):
        self.conn.close()

    def fetch_ecowitt_data(self, host='ecowitt'):
        timestamp = time.strftime('%Y-%m-%d %H:%M:%S%z', time.localtime())
        result = []
        response = requests.get(f'http://{host}/get_livedata_info')
        if response.status_code != 200:
            return result
        # Ecowitt battery status: 0: low; 1-5: ok, 6: external power
        if host in ['ecowitt', 'ecowitt0']:
            data = response.json()
            print(f'Fetched data from {host}: {json.dumps(data, indent=4)}')
            metrics = {
                'wh25': [
                #    ('intemp', 'office temperature', '°F'),
                #    ('inhumi', 'office humidity', '%'),
                    ((), 'abs', 'office', 'absolute pressure', 'inHg'),
                    ((), 'rel', 'office', 'relative pressure', 'inHg')
                ],
                'co2': [
                    ((), 'temp', 'office', 'temperature', '°F'),
                    ((), 'humidity', 'office', 'humidity', '%'),
                    ((), 'CO2', 'office', 'CO2', 'ppm'),
                    ((), 'CO2_24H', 'office', 'CO2 24H average', 'ppm')
                ],
                'ch_temp': [
                    (('channel', '1',), 'temp', 'tank room', 'temperature', '°F'),
                    (('channel', '1',), 'battery', 'tank room', 'battery', ''),
                    (('channel', '1',), 'voltage', 'tank room', 'voltage', 'V'),
                ],
            }
            print(f'metrics={json.dumps(metrics,indent=4)}')

            for key, metric_list in metrics.items():
                if key not in data:
                    print(f'Skipping missing key: {key}')
                    continue
                for qualifier, field, location, metric, units in metric_list:
                    for sensor_data in data[key]:
                        if field not in sensor_data:
                            print(f'Skipping missing field: {field} in key: {key}')
                            continue
                        if qualifier and sensor_data.get(qualifier[0], None) != qualifier[1]:
                            print(f'Skipping due to qualifier mismatch: {qualifier}')
                            continue
                        datum = sensor_data[field]
                        datum = re.sub(r'(%?| .*)$', '', datum)
                        value = float(datum)
                        result.append((timestamp, location, metric, units, value))
        print(f'Parsed data points: {json.dumps(result, indent=4)}')
        return result

    def poll(self, hosts=['ecowitt']):
        for host in hosts:
            data_points = self.fetch_ecowitt_data(host)
            for timestamp, location, metric, units, value in data_points:
                print(f'Inserting: {timestamp}, {location}, {metric}, {units}, {value}')
                self.insert_data(timestamp, location, metric, units, value)

if __name__ == '__main__':
    gatherer = GatherEcowitt()
    try:
        gatherer.poll(hosts=['ecowitt'])
    finally:
        gatherer.close()
