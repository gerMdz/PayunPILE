## Bienvenido a PayunPILE
### SMTP

La configuración del servidor de correos se realiza desde el archivo.
Se basa en el componente [Mailer](https://symfony.com/components/Mailer) de [Symfony](https://symfony.com)

```
.env (archivo de distribución original)
.env.local (archivo de configuración en desarrollo)
.env.local.php (archivo de configuración en producción)
```
`
MAILER_DSN=smtp://user:pass@host:puerto?encryption=tls&auth_mode=login
`

El código que procesa los correos se encuentra en el servicio Mailer
```
src/Service/Mailer.php
```
Este es el archivo que debe modificar si desea cambiar la forma 
de actuar de reservas.


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