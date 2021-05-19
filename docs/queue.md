## Bienvenido a PayunPILE
### Queue "Colas"

Si en lugar de enviar directamente los mails, se desean poner en 
una cola de espera (porque su servidor de correos acepta solo una 
pequeña cantidad de correos salientes, por ej.) en el archivo de 
configuración debe colocar QUEUE_ENABLE en true

```
.env (archivo de distribución original)
.env.local (archivo de configuración en desarrollo)
.env.local.php (archivo de configuración en producción)
```
`
QUEUE_ENABLE=true
`

El comando 
```
php bin/console app:procesa-delay
```

Procesa los correos que se encuentran en cola.
Esta funcionalidad todavía está en desarrollo.

Las colas se administran desde [/admin/queuetransport/list](/admin/queuetransport/list)

Primero debe crear una queue, que será procesada para el envío de 
los mails.

En caso de que su proveedor de hosting no permita el acceso
a la shell de php, entonces se puede hacer cron a la ruta
[/delay/{hashkey}/transport](/delay/{hashkey}/transport) donde
{hashkey} es el identificador de la cola.


#### Menú
[Volver al inicio][10]


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
[10]: https://germdz.github.io/PayunPILE/
[11]: https://twig.symfony.com/