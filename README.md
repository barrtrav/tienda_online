# tienda_online

Para ejecutar o montar el server este es el comando:
> php -S 127.0.0.1:8000 -t public

La conecciond de la base de datos se configura en el archivo .env 
> DATABASE_URL="mysql://root:Mysql2024@127.0.0.1:3306/tienda_online"

[Nota] Junto con el proyecto de adjunta una copia de la base de datos, los datos se pueden general con un fake, pero en el caso que no se quiera general estos datos se monta la copia de la base de datos , se establece la conexion a esa base de datos y se prueban las funcionalidades.

Requeriminetos 
* Symfony 5.4.99
* PHP 7.4.33