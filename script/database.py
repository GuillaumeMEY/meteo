#Util class for commonicate with the database

import mariadb
from dotenv import load_dotenv
import os
import sys

load_dotenv()

"""
TODO: 
 - Implement one function query builder for make sql querie to the DB 
    => return success and the id of item created
 - Maybe Implement specific queries for table 
"""

class Database:
    def __init__(self):
        self.host = os.getenv('DB_HOST')
        self.user = os.getenv('DB_USER')
        self.password = os.getenv('DB_PASSWORD')
        self.database = os.getenv('DB_NAME')
        self.port = os.getenv('DB_PORT')
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
        
    def query_builder(self, query, data):
        try:
            self.cursor.execute(query, data)
            print("Success of the query")
        except mariadb.Error as e:
            print("Error while executing the query: {0}".format(e))
    
    def insert_into_Measures(self, type, value, source):
        try:
            query = "INSERT INTO Measures(type, value, source) values(?,?,?)"
            data = (type, value, source)
            self.cursor.execute(query, data)
            id = self.cursor.lastrowid
            return id
        except mariadb.Error as e :
            print("Error while insert into Measures: {0}".format(e))
