# Redis server

## Redis installation on your pc (local use)

### Official link 
<https://redis.io/>

### Under Windows
You can follow this page which presents its installation. (link French) 
<https://www.supinfo.com/articles/single/8843-redis-installation-windows>

### Under Linux (Debian)
You can follow this page which presents its installation. (link english)
<https://tecadmin.net/install-redis-on-debian/>

### Do not use Redis

If you don't want or can't use Redis.

- Delete the `EventSubscriber`  folder in the Controller folder.    

This is sufficient to operate the site. You can also.  

- Delete the `snc_redis.yaml`  file in the config folder.    
- Delete the `bind.snRedisDefault`  line in the services.yaml file.  
- Delete the `"Predis"`  and `"snc_redis"`  libraries via composer. `composer remove .....`    