## Bienvenido a PayunPILE
### Correos

El texto de los correos aún no son editables desde la aplicación.
Las modificaciones deben hacerse directamente desde las plantillas
de mail ubicadas en
```
templates/email
```
`
templates/email/reserva.html.twig
`
```
<a href="{{ base.metaUrl }}">
  <img src="{{ email.image('@images/logo-mail.png') }}"  class="logo" alt="{{ reservante.celebracion.nombre }}">
</a>
```

Las platillas son llamadas desde el servicio Mailer
```
src/Service/Mailer.php
```
Este es el archivo que debe modificar si desea cambiar de 
plantilla principal de reservas.

Se basan en [Twig][11]

##### Pasos siguientes

- Configuración de cuerpos-mail con unidades-reserva 

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
