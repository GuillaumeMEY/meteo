#Util class for commonicate with the database

import mariadb
from dotenv import load_dotenv
import os
import sys

load_dotenv()
class Database:
    def __init__(self):
        self.host = os.getenv('DB_HOST')
        self.user = os.getenv('DB_USER')
        self.password = os.getenv('DB_PASSWORD')
        self.database = os.getenv('DB_NAME')
        self.port = int(os.getenv('DB_PORT'))
        self.con, self.cursor = self.connection()
    
    def connection(self):
        try:
            conn = mariadb.connect(
                user=self.user,
                password=self.password,
                host=self.host,
                port=self.port,
                database=self.database
            )
            print("Connection successfuly initialised with mariadb")
        except mariadb.Error as e:
            print("Error connecting to mariadb: {0}".format(e))
            sys.exit(1)
        
        return conn, conn.cursor()
    
    def close_connection(self):
        self.con.close()
        
    def query_builder(self, query, data):
        try:
            self.cursor.execute(query, data)
            print("Success of the query")
        except mariadb.Error as e:
            print("Error while executing the query: {0}".format(e))
    

    # data need to be an array of tuples
    def insert_into_Measures(self, data):
        try:
            query = "INSERT INTO Measures(type, value, source) values(?,?,?)"
            self.cursor.executemany(query, data)
            id = self.cursor.lastrowid
            print("Insert into Measures succesfull")
            return id
        except mariadb.Error as e :
            print("Error while insert into Measures: {0}".format(e))
