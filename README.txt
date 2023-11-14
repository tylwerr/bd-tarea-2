Datos personales:
	- Nombre: Daniel Rodrigo Maturana Cristino
	- ROL USM: 202173575-5

   	- Nombre: Carlos Andrés Arévalo Guajardo
    - ROL USM: 202173501-1 

Detalles de uso del programa:
	
	- Para la correcta ejecuccion del programa, se recomienda localizar la carpeta de la tarea en la carpeta htdoc de la ruta de xampp.

	- Al momendo de ejecutar el codigo, se necesita de la herramienta de XAMPP en la version 3.3.0 en adelante, donde se utilizara tanto el modulo de Apache como el de MySQL.

	- Como nuestra base de datos es del formato localhost, tanto la base de datos como la pagina están diseñados en un formato local.


Consideraciones:

	- Todos los archivos del estilo .PHP están localizados en su propia carpeta, por otro lado, tanto los .JPG como los .PNG deben estar organizados en otra carpeta.

	- Para una mejor implementacion en la base de datos, se crearon tanto llaves primarias como llaves foraneas, ademas de eliminacion en cascada para un funcionamiento correcto.

	- Al momento del registro de la pagina, se asume que el usuario solamente se registrará una unica vez y las siguientes veces solamente iniciara sesion.

	- En la pagina principal, si el usuario desea ir al apartado de sus alimentos favoritos, puede ir tanto en el sub-menu que aparecera al momento de precionar su nombre, o llendo a perfil y luego llendo a favoritos desde el mismo perfil.

	- Las votaciones semanales toma 3 comidas del estilo "Plato de fondo" que son completamente al azar, pero no se actualizaran por motivos de implementacion, ya que no se actualizan los viernes a las 3 de la tarde como se menciona en el enunciado de la tarea.

	- En el apartado de recetas del casino, si se quiere hacer algun tipo de filtro, se debera seleccionar el filtro deseado y apretar en el boton de buscar para que se ejecute la busqueda.

	- Si se desea eliminar la cuenta, se eliminaran todos los datos relacionados con el usuario debido a la implementacion de la base de datos.

	- Si el usuario quiere editar sus datos, se asume que quiere cambiar todos sus datos, tanto el correo como su nombre y la cantidad de almuerzos.

Detalles de las herramientas usadas:
	- Sistema Operativo (SO):
		Edición	Windows 10 Home Single Language
		Versión	22H2
		Compilación del sistema operativo	19045.3324
		Experiencia	Windows Feature Experience Pack 1000.19041.1000.0
	- XAMPP v3.3.0

	- Librerias:
		MySQL==8.0.34
