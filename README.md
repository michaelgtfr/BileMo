# BileMo

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c9daa88dee3843c592c1cf86f033e617)](https://www.codacy.com/manual/michaelgtfr/BileMo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=michaelgtfr/BileMo&amp;utm_campaign=Badge_Grade)

## Specifications

### Context

BileMo is a company offering a wide selection of high-end mobile phones.

You are in charge of the development of the BileMo mobile phone showcase.
BileMo's business model is not to sell its products directly on the website, but to provide all
platforms that want access to the catalog via an API (Application Programming Interface).
It is therefore sales exclusively in B2B (business to business).

### Customer needs

The first customer has finally signed a partnership contract with BileMo! It’s the fight to respond to
needs of this first client who will allow to set up all the APIs and test them right away.

After a dense meeting with the client, a number of information was identified. It must be possible to:

    consult the list of BileMo products;
    view the details of a BileMo product;
    consult the list of registered users linked to a client on the website;
    view the details of a registered user linked to a client;
    add a new user linked to a client;
    delete a user added by a client.
    
Only referenced customers can access the APIs. API clients must be authenticated via OAuth or JWT.

### Data presentation

The first partner of BileMo is very demanding:
it requires that you expose your data following the rules of levels 1, 2 and 3 of the Richardson model.
He asked that you serve the data in JSON. If possible, the client wishes the responses to be brought into
cache in order to optimize the performance of requests to the API.
 
## Installation 

### Prerequisites

#### Download libraries via composer

Go to the root folder of the site. 
In the root folder right click the mouse and then press git bash (or equivalent software). 
The Open software write " composer install ". The libraries will be installed automatically in a vendor folder.
    
#### Redis server

In the API, "Redis" is used for protection against brute force attacks.
By using its cache, its recovery is faster, avoids storing in the MySQL database
and allows automatic deletion of cached data.

If you do not want or cannot use the Redis server, read the **_redis.md_** documentation
in the **Resources/doc/** folder.

#### Set up in a host

-Offer accommodation on a hosting.  
-Have a domain name that will be the address on which your site will be accessible.  
-Have its ID on its hosting (host, password, Identifying).  
-Have installed an FTP on his computer.  

### Site installation on a host

(Example with FileZilla but all FTP works on the same principle)

Open your FTP software. Click on the logo "site manager". A window opens. Click on "New Site" and give it the name you
 want (example: "My Site"). To the right, you will have to indicate (the IP address, password and its username). 
 Click Connect.
!Warning a message warns you after you click Connect you tell yourself if you are connecting or not.
After connecting, double-click in the left window on the files or click-Drop the folders in the right window that you 
want to send to the server. As soon as it appears in the right window, it was sent to your server.
!Please note that your home page should be call index.php This is the page that will be loaded when a new visitor 
arrives on your site.

### Database installation

#### Required

-The IP address of the MySQL server      
-Your MySQL Login      
-Your MySQL password     
-The name of the database, if it has already been created      
-The PhpMyAdmin address that allows you to manage your online database     
  
#### Access

Changed the parameter file of the database (.env.local.php). Now that it's done, your scripts have access to the host
database.
!If your table is still empty, you have to use the phpMyAdmin that the hosting puts at your disposal to recreate the 
tables. On your machine, go to your local phpMyAdmin. Use it to export all your tables. This will create a. sql file 
on your hard disk that will contain your tables. Then go to the phpMyAdmin address of your host. Once there, use the 
Import feature to import the. sql file that is on your hard disk. Your tables are now loaded on the host's MySQL server.  
 
#### Website configuration
 
Do not forget to modify the configuration in the '.env.local.php' file.  
On a web host, modify the access path to the public file for the domain on the administration page.
    
   **Site installation Complete**
     
### Use of API

To use the API, you can go to the documentation via the API, link `/api/doc` (html) or `/api/doc.json` (json) 
Either use the document located in `Resource/doc/useOfAPI.md` .