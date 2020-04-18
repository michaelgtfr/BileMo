# LexikJWTAuthenticationBundle

LexikJWT is the service allowing you to authenticate via a token that you will put in the HTTP header (authorization). 
They will be given to you after you are authenticated (see `Resource/doc/useOfAPI.md` for more information on connection).

## Link Official

this link allows you to have all the details on its use (English link).  
<https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#installation>  

The only things to do are detailed below the rest of the elements are already created

## Installation

### Prerequisites

The openssl extension.

if you don't have OpenSSL installed on your PC you can go to this site
explaining how to install the extension (link english).

#### Windows
<https://tecadmin.net/install-openssl-on-windows/>

### Generate the SSH keys:

In your terminal

`$ mkdir -p config/jwt`  
`$ openssl genpkey -out config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096`  
`$ openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout`  

### Configuration

Update the .env.local.php file, here it is finished.
