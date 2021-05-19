## Bienvenido a PayunPILE

Sistema de reservas para eventos


### ¿Que resuelve?
Poder hacer reservas para eventos, definiendo horario y lugar, 
con envío de mail de confirmación, donde pueda tener pleno control 
del código, y con un [framework][1] líder en PHP como lo es [Symfony][1]
Fácil de actualizar, fácil de mantener, con un árbol de directorios claro.

### ¿Qué más tiene?

Tiene un manejo básico de usuarios para la administración de los contenidos.


### ¿Cómo lo obtengo?

Para usar PayunPILE debes bajarlo de [github][8], y luego bajar sus 
dependencias de paquetes.

```
git clone https://github.com/gerMdz/PayunPILE.git
cd project
composer install
yarn install 
```


Requerimientos
------------

* PHP 7.2.9 o superior;
* PDO-SQLite PHP extension enabled (o el PDO para tu base de datos);
* y los [usuales requerimientos de una aplicación Symfony][2].

Uso
-----

Las configuraciones básicas son
* la URL de su base de datos ej.:
    * DATABASE_URL=
mysql://user:password
@ip:port/
db_name
* el DSN de su servidor smtp de correos
    * MAILER_DSN=smtp://localhost

Luego con el binario de [Symfony][4], ejecute los siguientes comandos que crearan los datos básicos de usuarios y un contenido de inicio:

```bash
$ php bin/console doctrine:fixtures:load
$ symfony serve -d
```

Luego acceda a la aplicación en su navegador con la URL dada (<https://localhost:8000> generalmente).

Si no tiene instalado el binario de Symfony, ejecute `php -S localhost:8000 -t public/`
para utilizar el servidor web PHP incorporado o [configure un servidor web][3] como Nginx o
Apache para ejecutar la aplicación.

### Elementos iniciales

- [x] Texto en los correos, ¿Que dirá el mail de confirmación? 
  [ver][10]
- [x] Logo de la página [ver][9]
- [x] Smtp de envío de los mails [ver][11]
- [x] Configurar el cron para la cola de envíos [ver](https://germdz.github.io/PayunPILE/queue)
- [x] Qué se reserva (asientos, lugar) en qué (reuniones, grupos)
- [x] Mail del sitio (si no fallará el envío de mail)
- [x] Creación de colas de envíos
- [x] Creación de tareas de cron


Tests
-----

Ejecute este comando para correr los tests:

```bash
$ ./bin/phpunit
```


## Atajos de teclado

#### Admin > Menú
> Windows - Linux


>Firefox 	Alt + Shift + m
Google Chrome 	Alt + m
Safari 	Alt + m


> Mac

>En Firefox 14 o posteriores, Control + Alt + m
En Firefox 13 o anteriores, Control + m
Control + Alt + m
Control + Alt + m

> Cualquier S.O.

>Opera 	Shift + Esc abre una lista de contenidos, los cuales son accesibles a través de accesskey, después se puede elegir un item presionando m


#### PayunPILE se base en
- [Symfony][1] framework PHP.
- [Bootstrap](https://getbootstrap.com/) plantillas.
- [FontAwesome](https://fortawesome.github.io/Font-Awesome/) icons.

Con licencia [MIT](https://github.com/gerMdz/PayunPILE/blob/main/LICENSE)

Uso [PhpStorm][5]


[1]: https://symfony.com
[2]: https://symfony.com/doc/current/reference/requirements.html
[3]: https://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://jb.gg/OpenSource.
[6]: https://github.com/gerMdz/payunpile
[7]: https://germdz.github.io/incalinks/
[8]: https://github.com/gerMdz/PayunPILE.git
[9]: https://germdz.github.io/PayunPILE/logos-e-imagenes
[10]: https://germdz.github.io/PayunPILE/correos
[11]: https://germdz.github.io/PayunPILE/smtp
