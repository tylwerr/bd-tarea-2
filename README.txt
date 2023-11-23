Datos personales:
	- Nombre: Daniel Maturana

   	- Nombre: Carlos Arévalo

Detalles de uso del programa:
	
	- Para la correcta ejecuccion del programa, se recomienda localizar la carpeta de la tarea en la carpeta htdoc de la ruta de xampp.

	- Al momendo de ejecutar el codigo, se necesita de la herramienta de XAMPP en la version 3.3.0 en adelante, donde se utilizara tanto el modulo de Apache como el de MySQL.

	- Como nuestra base de datos es del formato localhost, tanto la base de datos como la pagina están diseñados en un formato local.


Consideraciones:

	- Todos los archivos del estilo .PHP están localizados en su propia carpeta, por otro lado, tanto los .JPG como los .PNG deben estar organizados en otra carpeta.

	- Para una mejor implementacion en la base de datos, se crearon tanto llaves primarias como llaves foraneas, ademas de eliminacion en cascada para un funcionamiento correcto.

	- Al momento del registro de la pagina, se asume que el usuario solamente se registrará una unica vez y las siguientes veces solamente iniciara sesion. Ademas de que debera poner la cantidad de almuerzos manualmente.

	- En la pagina principal, si el usuario desea ir al apartado de sus alimentos favoritos, puede ir tanto en el sub-menu que aparecera al momento de presionar su nombre, o dirigiendose al perfil y luego a favoritos desde el mismo perfil.

	- Las votaciones semanales toma 3 comidas del estilo "Plato de fondo" que son completamente al azar, pero no se actualizaran por motivos de implementacion, ya que no se actualizan los viernes a las 3 de la tarde como se menciona en el enunciado de la tarea.

	- En el apartado de recetas del casino, si se quiere hacer algun tipo de filtro, se debera seleccionar el filtro deseado y apretar en el boton de buscar para que se ejecute la busqueda.

	- Si se desea eliminar la cuenta, se eliminaran todos los datos relacionados con el usuario debido a la implementacion de la base de datos.

	- Si el usuario quiere editar sus datos, se asume que quiere cambiar todos sus datos, tanto el correo como su nombre y la cantidad de almuerzos.

	- Se implemento una view, trigger y procedimiento almacenado mediante el diseñador en phpmyadmin, esto se encontrara dentro de la base de datos exportada.

	- Para editar las resenas hechas por el usuario, este debera ir a su perfil y de ahi buscar la que quiere cambiar (OJO, se actualizara como la resena mas reciente).

	- Los botones atras redirigen a una pagina y no se usa el href="javascript:history.back()", ya que generaba un bucle en ciertos casos. 

	- El archivo top_bar.php ademas de incluir la barra donde se ve el perfil, incluye otras lineas de codigo que se repetian en los demas archivos. Esto para ahorrar lineas y mejor orden.

	- En las recetas, el orden predefinido de calificacion es de menor a mayor.

Detalles de las herramientas usadas:
	- Sistema Operativo (SO):
		Edición	Windows 10 Home Single Language
		Versión	22H2
		Compilación del sistema operativo	19045.3324
		Experiencia	Windows Feature Experience Pack 1000.19041.1000.0

	- XAMPP v3.3.0	
	- MySQL==8.0.34
	- PHP == 8.2.11
