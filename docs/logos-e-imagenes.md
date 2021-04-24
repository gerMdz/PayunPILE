## Bienvenido a PayunPILE
### Logos e imágenes

Los logos e imágenes se guardan dentro de la carpeta /public/images

Si se decide mantener el código, entonces esas imágenes deben llamarse:

* base.png 
  * Es la imagen de fondo de la página de reservas
* logo.png
  * Es el logo que aparece en la parte superior y que hace de botón 
    para el home del sitio
* logo-mail.png
  * Es el logo que se envía en los correos de confirmación de las reservas

Normalmente se suben al sitio por ftp.


### Configurando rutas

Para configurar las distintas rutas donde estarán las imágenes y los archivos css
deben editarse los siguientes archivos

`
config/packages/twig.yaml
`
```
twig:
  // otras configuraciones
  paths:
    'public/images': images
    'public/css': styles
  // otras configuraciones 
```
`
config/services.yaml
`
```
parameters:
    // otras configuraciones
    image_directory : '%kernel.project_dir%/public/image'
    // otras configuraciones
```
`
templates/email/reserva.html.twig
`
```
<a href="\{\{ base.metaUrl \}\}">
  <img src="\{{ email.image('@images/logo-mail.png') }}"  class="logo" alt="{{ reservante.celebracion.nombre }}">
</a>
```

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