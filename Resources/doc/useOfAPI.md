#Use Of API:

To be able to use the API, you must have a Client account given by the administrator,
only the home page, the connection pages, and the documentation pages are accessible without connection.


##Homepage ('/')

Home page (html) accessible without connection, it contains a welcome message,
brief presentation of the site and the links to the connection page (html) and the documentation page (html).


## Documentation html ('api / doc')

Allows via a graphical interface without connection to inform about the different functionality of the API, 
it also allows to use the API via this interface (with connection).


## Documentation ('api/doc.json', method= ['GET'] )

Allows via an API platform or your website, in Json format without connection, 
to inform you about the different API functionalities.

**Send :** (status 200)


##Connection page html ('/login')

Allows a client to connect to the API via a graphical interface.

**Required to connect:**   
`- Username(email)`  
`- Password`

**Send :** (status 200)  
`- Username`   
`- Token` 

_expiration: 2 hours_


##Connection Json ( 'api/login', method = ['POST'] )

Allows a client to connect to the API via your website or API platform (ex: Postman)

**Required to connect (Json format):**  
`- Username(email)`  
`- Password`

**Send :** (status 200)   
`- Token`  
`- Refresh token`

_expiration: 1 hours_


## Refresh token ( 'api/token/refresh', method= ['POST'])

allows a client to use the refresh token to update their authentication, this saves the system time for authentication.

**Required to connect (Json format):**  
`- Refresh token`

**Send :** (status 200)   
`- Token`  
`- Refresh token`

_expiration: 2 hours_


## Products list ( 'api/products', method= ['GET'] )

Allows retrieving the list of products. data recovered in Json.

**Send :** (status 200)  
`- List of products`  
`- Customer data`  
`- Paging metadata`
`- Link usable in relation to Products`


## Product detail ( 'api/product/{id}, method= ['GET'] )

Allows to retrieve the details of a product.

`{id} = (int) id of product.`

**Send :** (status 200)   
`- Product detail`  
`- Customer data`  
`- Links usable in relation to the products`  
`- Date of request`  

## Users list ( 'api/users', method= ['GET'] )

Allows to retrieve the list of its users.

**Send :** (status 200)  
`- List of its users`  
`- Customer data`  
`- Paging metadata`
`- Link usable in relation to users`


## User detail ( 'api/user/{id}, method= ['GET'] )

Allows to retrieve the detail of one of its users.

`{id} = (int) id of user.`

**Send :** (status 200)   
`- User detail`  
`- Customer data`  
`- Links usable in relation to the user`  
`- Date of request` 

##Creating a user ( 'api/user, method= ['POST'] )

Allows the creation of a user.

Required for creation (Json format):  
`- name (string)`  
`- firstname (string)`  
`- country (string)`  
`- address (string)`  
`- email (string)`  

**Send :** (status 201)  
`- User data sent with their unique id created by the system`  
`- Customer data`  
`- Link usable in relation to users`  


## Deleted user ( 'api/delete/{id}, method= ['Delete'] )

Allows deletion of one of its users.

`{id} = (int) id of user.`

**Send :** (status 202)  
`- Success message`  
`- Reminder on deleted data`  
`- Recall on customer data`  
`- Link usable in relation to the user`  
