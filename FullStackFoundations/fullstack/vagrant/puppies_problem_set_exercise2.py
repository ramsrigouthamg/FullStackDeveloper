from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from puppies import Base, Shelter, Puppy

engine = create_engine('sqlite:///puppyshelter.db')
Base.metadata.bind=engine
DBSession = sessionmaker(bind = engine)
session = DBSession()

import datetime

#Exercise 1

#1. Query all of the puppies and return the results in ascending alphabetical order
"""
puppies = session.query(Puppy).order_by(Puppy.name)

for puppy in puppies:
	print puppy.name
"""
#2. Query all of the puppies that are less than 6 months old organized by the youngest first
"""
today = datetime.date.today()
days_old = 6 * 30
sixmonthsdate = today - datetime.timedelta(days = days_old)

puppies = session.query(Puppy).filter(Puppy.dateOfBirth > sixmonthsdate).order_by(Puppy.dateOfBirth.desc())

for puppy in puppies:
	print puppy.dateOfBirth
"""
#3. Query all puppies by ascending weight
"""
puppies = session.query(Puppy).order_by(Puppy.weight)

for puppy in puppies:
	print puppy.weight
"""
"""
#4. Query all puppies grouped by the shelter in which they are staying

puppies = session.query(Puppy).order_by(Puppy.shelter_id)

for puppy in puppies:
	print puppy.name , " ",puppy.shelter.name
"""



