# Fuber
A RESTful API service similar to a cab booking service with user registration,driver registration,booking and fare calculation.


Used Laravel as the framework and MySQL as the database

Includes:-
 ·  Fleet of cabs where each cab has a location, determined by it’s latitude and longitude.
·  A customer can call one of the taxis by providing their location, and assignation of the nearest taxi to the customer.
·  Some customers are particular that they only ride around in pink cars, for hipster reasons.
·  When the cab is assigned to the customer, it can no longer pick up any other customers
·  If there are no taxis available,rejection of the customers request.
·  The customer ends the ride at some location. The cab waits around outside the customer’s house, and is available to be assigned to another customer.
·  Used Pythagorus theorem instead of Haversine's formula
·  The price is 1 dogecoin per minute, and 2 dogecoin per kilometer. Pink cars cost an additional 5 dogecoin.
·  A bootstrapped front end with filtering capabilities for the total cars available.



