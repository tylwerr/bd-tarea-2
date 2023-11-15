-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2023 a las 01:18:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sabor usm`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `EliminarResena` (IN `new_id_user` INT, IN `new_id_receta` INT)   BEGIN
    DELETE FROM resenas 
    WHERE id_receta = new_id_receta AND id_user = new_id_user;
    
    SELECT AVG(calificacion) INTO @promedio
    FROM resenas
    WHERE id_receta = new_id_receta;
    
    UPDATE recetas
    SET promedio_calificaciones = @promedio
    WHERE id_receta = new_id_receta;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritos`
--

CREATE TABLE `favoritos` (
  `id_favorito` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `favoritos`
--

INSERT INTO `favoritos` (`id_favorito`, `id_user`, `id_receta`) VALUES
(10, 26, 7),
(11, 26, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones_votacion_semanal`
--

CREATE TABLE `opciones_votacion_semanal` (
  `id_opcion` int(11) NOT NULL,
  `nombre_opcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recetas`
--

CREATE TABLE `recetas` (
  `id_receta` int(11) NOT NULL,
  `nombre_receta` varchar(255) NOT NULL,
  `tipo_platillo` varchar(255) NOT NULL,
  `tiempo_preparacion` time NOT NULL,
  `etiquetas` varchar(255) NOT NULL,
  `instrucciones` text NOT NULL,
  `ingredientes` text NOT NULL,
  `ingredientes_filtro` text NOT NULL,
  `promedio_calificaciones` float NOT NULL,
  `url_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recetas`
--

INSERT INTO `recetas` (`id_receta`, `nombre_receta`, `tipo_platillo`, `tiempo_preparacion`, `etiquetas`, `instrucciones`, `ingredientes`, `ingredientes_filtro`, `promedio_calificaciones`, `url_imagen`) VALUES
(1, 'Lasaña Tradicional', 'Plato de fondo', '01:00:00', 'Tiene gluten,Tiene lactosa', '1. En una sartén mediana calentar un poco de aceite de Oliva y rehogar por unos minutos la cebolla y el ajo, hasta que estén dorados.\r\n\r\n2. Incorporar la zanahoria rallada y cocinar por unos minutos más, luego los pimientos en cubos y la cuchara de pimentón.\r\n\r\n3. Agregar la carne picada y mezclar bien a fuego medio. Salpimentar.\r\n\r\n4. Agregar la Salsas de tomate junto a las hojas de laurel.\r\n\r\n5. Cocinar a fuego suave, hasta que todo esté cocido. Reservar.\r\n\r\n6. Cocinar las láminas de Lasaña, según indica el envase: en una olla grande, hervir de agua con sal. Agregar las láminas de Lasaña y cocinar por 5 minutos (revolver en forma constante).\r\n\r\n7. Una vez cocidas, colar y sumergir en agua fría hasta el momento de armar la lasaña.\r\n\r\n8. Precalentar el horno 15 minutos a temperatura alta.\r\n\r\n9. En una fuente para horno, enmantequillar el fondo. Agregar una capa de salsa boloñesa. Agregar una capa de Lasaña y una capa de salsa cubrir con queso parmesano rallado.\r\n\r\n10. Repetir el paso anterior dos veces más. Cubrir bien con queso.\r\n\r\n11. Cocinar por 15 minutos. Dejar gratinar el queso. Servir de inmediato.', '200g Lasaña Tradicional\r\n2 sobres de Salsa de Tomate\r\n200 g carne picada\r\n1 zanahoria rallada\r\n1 cebolla en cubos\r\n1 diente de ajo picado\r\n1/2 pimiento rojo en cubos\r\n1/2 pimiento verde en cubos\r\n1 cucharada de Pimentón\r\n3 hojas de laurel\r\nQueso parmesano\r\nAceite de oliva\r\nSal y pimienta', 'Salsa de tomate,Carne molida,Zanahoria,Cebolla,Ajo,Pimiento rojo,Pimiento verde,Pimenton en polvo,Laurel,Queso parmesano,Aceite de oliva,Sal y pimienta', 4.5, 'https://thefoodtech.com/wp-content/uploads/2022/07/lasagna--828x548.jpg'),
(2, 'Cus cús a la chilena', 'Entrada', '00:10:00', 'Apto para diabéticos,Sin lactosa,Tiene gluten,Apto para veganos', '1. Se pela el tomate y se sacan las semillas y se cortan en pequeños cubos.\r\n\r\n2. En una olla se hierve 300 cc de agua con un poco de sal, se agrega el cuscús y se deja cocinar a fuego lento por un minuto. Enseguida se deja reposando por 5 minutos.\r\n\r\n3. Mientras tanto en un sartén se preparan los huevos revueltos y al estar listos se pican o muelen bien.\r\n\r\n4. Luego se agrega un poco de aceite al cuscús, el tomate picado y los huevos. Se condimenta con sal y pimienta. Al momento de servir se espolvorea con perejil.', '1 tomate maduro y firme\r\n200 grs. de cuscús\r\nPerejil picado\r\nAceite de oliva\r\n2 huevos\r\nSal y pimienta', 'Tomate,Cus cus,Perejil,Aceite de oliva,Huevos,Sal y pimienta', 3.5, 'https://res.cloudinary.com/postedin/image/upload/d_cookcina:no-image.jpg,f_auto,q_80/cookcina/c-postedin-image-33912.jpeg'),
(3, 'Sémola con leche', 'Postre', '02:35:00', 'Tiene gluten,Tiene lactosa', 'Para el caramelo:\r\n\r\n1. Poner el azúcar en una olla a fuego medio. Agregar el agua y jugo de limón.\r\n\r\n2. Cocinar sin revolver hasta obtener un color ámbar.\r\n\r\n3. Apagar el fuego y agregar 2 cucharadas de agua hirviendo. Integrar y reservar\r\n \r\n\r\nPara la sémola:\r\n\r\n1. Poner la leche, cáscara de naranjas, palito de canela y azúcar en una olla.\r\n\r\n2. Cocinar a fuego medio revolviendo constantemente hasta que la mezcla hierva.\r\n\r\n3. Bajar el fuego al mínimo, retirar la canela y cáscara de naranja.\r\n\r\n4. Agregar la sémola y revolver hasta que espese (3 a 4 minutos).\r\n\r\n5. Apagar el fuego, agregar la Esencia de Vainilla y revolver hasta integrar.\r\n\r\n6. Vaciar la mezcla en pocillos individuales, dejar enfriar y luego refrigerar 2 horas.\r\n\r\n7. Ponerle el caramelo reservado a cada porción.', 'Para caramelo:\r\n3/4 taza de azúcar\r\n2 cucharadas de agua fría\r\n2 cucharadas de agua hirviendo\r\n1 cucharada de jugo de limón\r\n\r\nPara sémola:\r\n4 tazas de leche descremada\r\n4 lonjas de cáscara de naranjas (sin la parte blanca)\r\n1 palito de Canela Entera Gourmet\r\n1/2 taza de azúcar\r\n2/3 taza de sémola\r\n1 cucharadita de Esencia de Vainilla Gourmet', 'Azucar,Limon,Leche descremada,Cascara de naranja,Canela,Semola,Esencia de vainilla', 4, 'https://cocinachilena.cl/wp-content/uploads/2012/01/semola-con-leche-10-scaled.jpg'),
(4, 'Lentejas con arroz', 'Plato de fondo', '01:30:00', 'Apto para diabéticos,Sin lactosa,Apto para veganos,Sin gluten', '1. Remojar las lentejas mientras preparas los otros ingredientes.\r\n\r\n2. Precalentar una olla a fuego medio y agregar el aceite, cebolla, zanahoria, y pimentón. Saltear hasta que la cebolla se dore ligeramente.\r\n\r\n3. Agregar las lentejas drenadas, el Ají de Color, Orégano, arroz y el Caldo en Polvo disuelto en el agua.\r\n\r\n4. Dejar que rompa hervor a fuego medio, para luego bajar el fuego al mínimo y tapar.\r\n\r\n5. Cocinar a fuego bajo por 45min-1 hora o hasta que estén suaves las lentejas.\r\n\r\n6. Agregar la Sal de Mar y servir calientes.', '2 tazas de lentejas\r\n1 cda aceite de oliva\r\n1/2 cebolla blanca picada fina\r\n1 zanahoria picada en cubitos pequeños\r\n1 pimentón rojo picado en cubitos pequeños\r\n1 cda de aceite de oliva\r\n1 cdta de Ají de Color Gourmet\r\n1/3 cdta Orégano Entero Gourmet\r\n1/2 taza de arroz\r\n6 tazas de agua\r\n2 sobres Caldo en Polvo de Tocino, Ajo y Cebolla Gourmet\r\n1 cda Sal de Mar Gourmet', 'Lentejas,Aceite de oliva,Cebolla,Zanahoria,Pimentos rojo,Aji color,Oregano,Arroz,Caldo en polvo,Ajo,Sal y pimienta', 3, 'https://www.gourmet.cl/wp-content/uploads/2022/05/lentejas-con-arroz-web-570x458.jpg'),
(5, 'Budín de zapallo italiano', 'Entrada', '01:00:00', 'Tiene gluten,Tiene lactosa', '1. Cortar los extremos de los zapallitos, partirlos en dos y cocinarlos en agua hirviendo hasta que estén blandos (30 minutos aprox.). Sacar del agua, picar toscamente y estilar en un colador para sacarle todo el líquido posible (aplastar con una cuchara).\r\n\r\n2. Calentar el horno a 180C. Enmantequillar una fuente de vidrio o cerámica que pueda ir al horno, reservar.\r\n\r\n3. Remojar el pan en la leche, hasta que esté blando.\r\n\r\n4. Calentar la mantequilla en una sartén, agregar la cebolla y cocinar hasta que la cebolla esté blanda y transparente. Agregar el ajo, Albahaca deshidratada Gourmet y Orégano deshidratado Gourmet, cocinar por un minuto.\r\n\r\n5. Juntar los zapallitos con el pan remojado, mezcla de cebolla y moler la mezcla con procesador o licuadora. Agregar los huevos, contenido del sobre de Caldo en Polvo de Verduras Gourmet y una taza de queso parmesano, revolver hasta tener una mezcla homogénea.\r\n\r\n6. Vaciar la mezcla en la fuente preparada y hornear por 50 minutos o hasta que el budín haya cuajado y la cubierta esté dorada.', '4 zapallitos italianos\r\n1 marraqueta\r\n1 taza de leche\r\n1 cucharada de mantequilla\r\n1 cebolla picada en cubos pequeños\r\n1/2 diente de ajo picado finito\r\n1/2 cucharadita de Albahaca deshidratada Gourmet\r\n1/2 cucharadita de Orégano deshidratado Gourmet\r\n4 huevos\r\n1 Sobre de Caldo en Polvo de Verduras Gourmet\r\n1 1/2 taza de queso parmesano', 'Zapallo italiano,Marraqueta,Leche descremada,Mantequilla,Cebolla,Ajo,Albahaca,Oregano,Huevos,Caldo en polvo,Queso parmesano', 4, 'https://cocinalocal.cl/wp-content/uploads/2021/08/budin-de-zapallo-italiano.jpg'),
(6, 'Leche asada', 'Postre', '03:35:00', 'Tiene gluten,Tiene lactosa', '1. Poner el azúcar en una olla y cocinar a fuego medio alto hasta tener un caramelo. Vaciar el caramelo en 4 fuentecitas o potes individuales (resistentes al calor). Reservar.\r\n\r\n2. En una olla, calentar la leche vegetal junto al maple o agave. Por otro lado, disolver la maicena en agua y luego agregar a la olla con la leche. Cocinar revolviendo hasta que la mezcla haya espesado. Apagar el fuego, agregar la esencia de vainilla, revolver bien y dividir en la potes con el caramelo.\r\n\r\n3. Refrigerar al menos 3 horas. Para servir, pasar un cuchillo por los bordes y luego dar vuelta sobre un plato.', '1/2 taza de azúcar\r\n3 tazas de leche de almendras o de coco\r\n6 cucharadas de maple o agave\r\n1/2 taza de maicena\r\n3 cucharadas de agua\r\n1 cucharadita de Esencia de Vainilla Gourmet', 'Azucar,Leche descremada,Maple,Maicena,Esencia de vainilla', 5, 'https://cocinalocal.cl/wp-content/uploads/2022/10/Leche-Asada.jpeg'),
(7, 'Charquicán', 'Plato de fondo', '01:00:00', 'Apto para diabéticos,Tiene gluten,Sin lactosa', '1. Cortar la carne en cubos de 1 cm (si se usa carne molida, saltar este paso).\r\n\r\n2. En una olla grande, calentar el aceite a fuego medio. Agregar la carne y cocinar por 5 minutos. Agregar la cebolla y el ajo y cocinar hasta que la cebolla esté blanda y transparente.\r\n\r\n3. Agregar las papas y zapallo, revolver bien. Incorporar el Ají de Color, Comino Molido y Orégano Entero, revolver hasta integrar. Agregar el agua y el Caldo en Polvo de Carne. Dejar hervir y luego reducir el fuego y cocinar por 25 minutos o hasta que las verduras estén blandas.\r\n\r\n4. Por último, agregar el choclo y los porotos verdes, cocinar por 5 minutos o hasta que estén blandos.\r\n\r\n5. Con la ayuda de una cuchara de palo, aplastar levemente las papas y zapallo y servir.', '1 kilo de asiento o carne molida\r\n2 1/2 cdas de aceite\r\n1 cebolla picada fina\r\n2 dientes de ajo picados fino\r\n6 papas en cubos de 1,5 cm\r\n400g de zapallo camote en cubos de 1,5 cm\r\n1,5 cdtas de Ají de Color Gourmet\r\n1/2 cdta de Comino Molido Gourmet\r\n2,5 cdtas de Orégano Entero Gourmet\r\n600ml de agua\r\n1 sobre de Caldo en Polvo de Carne Gourmet\r\n2 tazas de choclo\r\n2 tazas de porotos verdes cortados a lo largo', 'Carne molida,Aceite de oliva,Cebolla,Ajo,Papas,Zapallo,Aji color,Comino,Oregano,Caldo en polvo,Choclo,Porotos verdes', 3.5, 'https://cocinachilena.cl/wp-content/uploads/2008/03/charquican-12-scaled.jpg'),
(8, 'Crema de tomates', 'Entrada', '00:45:00', 'Tiene gluten,Tiene lactosa', '1. Calentar el horno a 200°C.\r\n\r\n2. Picar los tomates en cuartos y ponerlos sobre una bandeja de horno. Rociar con 2 cucharadas de aceite de oliva, espolvorear con el azúcar, Sal de Mar Gourmet, Pimienta Blanca Gourmet y las hierbas deshidratadas. Hornear los tomates por 30 minutos o hasta que estén blandos.\r\n\r\n3. En una olla grande, calentar la cucharada de aceite restante. Agregar la cebolla, ajo, apio y zanahoria y cocinar hasta que las verduras estén blandas. Una vez listo los tomates, agregarlos a la olla junto con el resto de los ingredientes (menos la crema) y cocinar por 10 minutos a fuego medio/bajo.\r\n\r\n4. Licuar la sopa hasta tener una mezcla homogénea; si desean una sopa de textura más suave, la pueden pasar por un colador. Calentar la sopa para servir; se puede agregar la crema en este punto o decorar con ella al servirla.', '3 cucharadas de aceite de oliva\r\n1 cucharada de azúcar\r\n1 cucharadita de Sal de Mar Gourmet\r\n1 kilo de tomates maduros lavados\r\n1 cucharadita de Pimienta Blanca Molida Gourmet\r\n1 cucharadita de cada uno de las siguientes hierbas: Orégano Gourmet, Tomillo Gourmet, albahaca Gourmet\r\n1 cebolla picada en cuadritos\r\n1 diente de ajo picado pequeño\r\n1 taza de apio picado pequeño\r\n1 zanahoria picada en cuadraditos pequeños\r\n1 cucharadita de Pimentón Paprika Gourmet\r\n1 cucharadita de Merquén Gourmet, o a gusto\r\n2 tazas de agua\r\n1 sobre de Caldo de Verduras en Polvo Gourmet\r\n3/4 taza de crema para servir', 'Aceite de oliva,Azucar,Sal y pimienta,Tomate,Oregano,Tomillo,Albahaca,Cebolla,Ajo,Apio,Zanahoria,Pimenton en polvo,Merquen,Caldo en polvo,Crema', 2.33, 'https://t1.uc.ltmcdn.com/es/posts/3/0/9/como_hacer_sopa_de_tomate_casera_25903_orig.jpg'),
(9, 'Granola', 'Postre', '00:25:00', 'Sin lactosa,Tiene gluten,Apto para veganos', '1. Precalentar el horno a 160°C.\r\n\r\n2. En un bowl, mezclar la avena, almendras, mix de semillas, canela y sal.\r\n\r\n3. Agregar la esencia de vainilla, aceite y miel. Revolver hasta que todo quede bien integrado e impregnado en los ingredientes secos.\r\n\r\n4. Sobre una bandeja de horno previamente engrasada o con papel mantequilla, poner la mezcla y esparcir de manera uniforme por toda la superficie. Hornear por 15 minutos o hasta que la granola esté dorada y las almendras se hayan tostado. A los 7 minutos es recomendable mover la granola con una paleta de madera para asegurarse de que se hornee de manera pareja.\r\n\r\n5. Una vez sacado del horno, dejar enfriar la granola sobre la lata. Agregar las pasas y pasar la granola a un envase hermético para almacenarla.', '2 tazas de avena tradicional\r\n1/2 taza de almendras laminadas (o cualquier otro fruto(s) seco(s))\r\n1/2 taza de mix de semillas (chía, linaza, maravillas, etc.)\r\n1/2 cdta de Canela Molida Gourmet\r\n1/4 cdta de Sal de Mar Gourmet\r\n1/2 cdta de Esencia de Vainilla Gourmet\r\n2 cdas de aceite vegetal\r\n4 cdas de miel de maple o miel de abejas\r\nPasas a gusto (opcional)', 'Avena,Almendras,Semillas,Canela,Esencia de vainilla,Aceite de oliva,Miel', 2, 'https://cdn.loveandlemons.com/wp-content/uploads/2020/01/granola.jpg'),
(10, 'Pastel de choclo', 'Plato de fondo', '00:50:00', 'Tiene gluten,Tiene lactosa', '1. Calentar el aceite en un sartén grande, agregar la cebolla picada y cocinar hasta que esté transparente y blanda. Agregar la carne picada y los aliños, cocinar hasta que la carne esté cocida (el pino debe estar jugoso). Agregar las pasas y reservar.\r\n\r\n2. Para la capa de choclo, sacar los granos de la coronta y luego procesar junto a la albahaca deshidratada, hasta tener una pasta. Calentar la mantequilla en una olla, agregar la pasta de choclo y cocinar un par de minutos. Agregar la leche y cocinar revolviendo hasta tener una mezcla espesa. Aliñar con sal y albahaca picada. Dividir el pino en 6 fuentes individuales (levemente enmantequilladas) o en una fuente de greda grande. Poner 2 aceitunas, medio huevo duro y una presa de pollo en cada una de las fuentes. Finalmente tapar con la pasta de choclo. Espolvorear con azúcar cada pastel.\r\n\r\n3. Calentar el horno a 190°C. Hornear los pasteles de choclo por 30 a 35 minutos o hasta que estén burbujeando y las cubiertas estén doradas.', 'Para el pino:\r\n\r\n1 cucharada de aceite\r\n2 cebolla en cuadrados pequeños\r\n500 gr de carne picada (posta negra)\r\n1 cucharadita de Comino Molido Gourmet\r\n1 cucharadita de Ají Color Gourmet\r\n1 cucharada de Orégano Entero Gourmet\r\n1 cucharadita de Condimento para Carne Gourmet\r\n1/2 taza de pasas\r\n6 trutro cortos sin piel, cocidos doraditos y jugosos\r\n3 huevos duros, cortados por la mitad\r\n1/2 taza de aceitunas negras\r\n\r\nPara el pastel:\r\n\r\n10 a 12 choclos pasteleros\r\n1 cucharadita de Albahaca Gourmet\r\n1 cucharada de mantequilla\r\n3/4 taza de leche\r\n1 cucharadita de sal\r\n5 hojas de albahaca, picadas\r\n\r\nPara cubrir:\r\n\r\n2 cucharadas de azúcar', 'Aceite de oliva,Cebolla,Carne molida,Comino,Aji color,Oregano,Pollo,Huevos,Aceitunas, Choclo,Albahaca,Mantequilla,Leche descremada,Sal y pimienta,Azucar', 4.5, 'https://www.comedera.com/wp-content/uploads/2022/12/Pastel-de-choclo-chileno.jpg'),
(11, 'Sopa de verduras', 'Entrada', '00:35:00', 'Apto para diabéticos,Sin lactosa,Apto para veganos,Sin gluten', '1. Picar las zanahorias, zapallitos y papas en trozos de 1cm aprox. Picar las espinacas en trozos pequeños. Reservar todas las verduras.\r\n\r\n2. En una olla grande, calentar el aceite y agregar la cebolla junto al apio, cocinar hasta que las verduras estén blandas y la cebolla transparente. Agregar el ají de color Gourmet, el comino Gourmet, el orégano Gourmet y el ajo Gourmet, cocinar revolviendo por 1 minuto.\r\n\r\n3. Añadir el agua caliente, el laurel Gourmet, rama de cilantro o perejil, las zanahorias, zapallitos, las papas, zapallo, sal de mar Gourmet y  mix de pimienta Gourmet; cocinar por 20 minutos a fuego medio bajo o hasta que las verduras estén blandas. Sacar el laurel y rama de cilantro. Incorporar los porotos verdes y hojas de espinacas picada, cocinar por 5 minutos.\r\n\r\n4. Al momento de servir espolvorear con cilantro picado.', '1 cebolla pequeña, picada en cubos\r\n1/4 taza de apio picado pequeño\r\n1 cucharada de aceite\r\n1/4 cucharadita de Ají de Color Gourmet\r\n1/2 cucharadita de Comino Molido Gourmet\r\n1/2 cucharadita de Orégano Molido Gourmet\r\n1/2 cucharadita de Ajo puro Gourmet\r\n1, 5 litros de agua caliente\r\n1 hoja de Laurel Gourmet\r\nUna rama de cilantro y/o perejil\r\n2 zanahorias\r\n2 zapallitos italianos\r\n3 papas grandes\r\n1 taza de zapallo en cubos\r\n1 taza de porotos verdes\r\n1 taza de hojas de espinacas\r\n1/4 taza de cilantro picado para servir.\r\nSal de Mar Gourmet a gusto\r\nMix Pimienta Gourmet a gusto', 'Cebolla,Apio,Aceite de oliva,Aji color,Comino,Oregano,Ajo,Laurel,Cilantro,Zanahoria,Zapallo italiano,Papas,Zapallo,Porotos verdes', 3.5, 'https://www.gourmet.cl/wp-content/uploads/2018/04/Sopa-editada-507x458.jpg'),
(12, 'Flan de coco', 'Postre', '01:10:00', 'Tiene gluten,Tiene lactosa', '1. Calentar el horno a 180C.\r\n\r\n2. Hacer un caramelo con el azúcar. Una vez listo vaciar sobre un molde de flan o de queque. Mover el molde para distribuir el caramelo por toda la superficie del molde.\r\n\r\n3. Poner los huevos en un bol grande y batir a velocidad baja por 30 segundos. Agregar las leches, la esencia de vainilla gourmet y  el coco rallado gourmet, batir hasta integrar. Vaciar la mezcla en el molde acaramelado.\r\n\r\n4. Hornear el flan a baño maría por 1 hora o hasta que la mezcla esté cuajada. Sacar de horno, dejar enfriar y luego refrigerar al menos 2 horas. Calentar levemente el fondo del molde, despegar los bordes con un cuchillo y luego dar vuelta sobre un plato. Servir decorado con coco rallado.', '3/4 taza de azúcar\r\n6 huevos\r\n1 tarro de leche condensada (397 gr)\r\n1 tarro de leche evaporada (375 gr)\r\n1 tarro de leche de coco (400 ml)\r\n1 cucharadita de Esencia de Vainilla Gourmet\r\n1 taza de Coco Rallado Gourmet', 'Azucar,Huevos,Leche condensada,Leche evaporada,Leche descremada,Esencia de vainilla,Coco', 4, 'https://d1uz88p17r663j.cloudfront.net/original/8666f995c7496495d6b9aa6b5ffb39f6_flan-de-coco.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `id_resenas` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL,
  `calificacion` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha_resena` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenas`
--

INSERT INTO `resenas` (`id_resenas`, `id_user`, `id_receta`, `calificacion`, `comentario`, `fecha_resena`) VALUES
(44, 24, 2, 4, 'Estaba rico', '2023-11-14 09:54:27'),
(45, 24, 4, 1, 'malo\r\n', '2023-11-14 09:55:31'),
(46, 24, 5, 3, 'Le falta sal', '2023-11-14 09:55:46'),
(47, 24, 10, 5, 'Estaba godines', '2023-11-14 09:56:04'),
(48, 24, 8, 1, 'Muy mala', '2023-11-14 09:56:22'),
(49, 25, 12, 4, 'Estaba muy dulce', '2023-11-14 09:57:30'),
(50, 25, 6, 5, '', '2023-11-14 09:57:42'),
(51, 25, 7, 2, '', '2023-11-14 09:57:49'),
(52, 25, 9, 1, '', '2023-11-14 09:57:57'),
(53, 25, 11, 5, '', '2023-11-14 09:58:06'),
(54, 25, 4, 4, 'ahi nomas', '2023-11-14 09:58:26'),
(55, 26, 8, 4, 'Estaba bueno pero falto sabor', '2023-11-14 21:00:44'),
(56, 26, 7, 5, 'Manjar de dioses', '2023-11-14 09:59:54'),
(57, 26, 1, 5, 'muy bueno', '2023-11-14 10:00:13'),
(58, 26, 6, 5, 'gracias dios', '2023-11-14 10:00:28'),
(59, 27, 9, 3, 'Pasable', '2023-11-14 21:09:52'),
(60, 27, 4, 4, '', '2023-11-14 21:11:00'),
(61, 27, 8, 2, '', '2023-11-14 21:11:18'),
(62, 27, 5, 5, '', '2023-11-14 21:11:27'),
(63, 27, 2, 3, '', '2023-11-14 21:11:39'),
(64, 27, 10, 4, '', '2023-11-14 21:11:50'),
(65, 27, 1, 4, 'Demasiado buena', '2023-11-14 21:12:13'),
(66, 27, 11, 2, '', '2023-11-14 21:12:24');

--
-- Disparadores `resenas`
--
DELIMITER $$
CREATE TRIGGER `calcular_promedio` AFTER INSERT ON `resenas` FOR EACH ROW BEGIN
    DECLARE promedio DECIMAL(5, 2);

    SELECT AVG(calificacion) INTO promedio
    FROM resenas
    WHERE id_receta = NEW.id_receta;

    UPDATE recetas
    SET promedio_calificaciones = promedio
    WHERE id_receta = NEW.id_receta;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre_usuario` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `cantidad_almuerzos` int(11) NOT NULL,
  `ultima_sesion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_usuario`, `contrasena`, `email`, `fecha_registro`, `cantidad_almuerzos`, `ultima_sesion`) VALUES
(24, 'Juan', '1234', 'juan@usm.cl', '2023-11-14 12:54:01', 5, '2023-11-14 10:02:27'),
(25, 'Benjamin', '1234', 'benja@usm.cl', '2023-11-14 12:56:57', 6, '2023-11-14 10:01:34'),
(26, 'Carlos', '1234', 'carlos@usm.cl', '2023-11-14 12:58:56', 7, '2023-11-14 21:15:12'),
(27, 'Daniel', '1234', 'dani@usm.cl', '2023-11-15 00:08:55', 5, '2023-11-14 21:13:28');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vista_resenas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `vista_resenas` (
`id_resenas` int(11)
,`id_user` int(11)
,`id_receta` int(11)
,`calificacion` int(11)
,`comentario` text
,`fecha_resena` datetime
,`email_usuario` varchar(255)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votos`
--

CREATE TABLE `votos` (
  `id_voto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_receta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `votos`
--

INSERT INTO `votos` (`id_voto`, `id_user`, `id_receta`) VALUES
(17, 26, 7),
(18, 25, 1),
(19, 24, 4);

-- --------------------------------------------------------

--
-- Estructura para la vista `vista_resenas`
--
DROP TABLE IF EXISTS `vista_resenas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vista_resenas`  AS SELECT `r`.`id_resenas` AS `id_resenas`, `r`.`id_user` AS `id_user`, `r`.`id_receta` AS `id_receta`, `r`.`calificacion` AS `calificacion`, `r`.`comentario` AS `comentario`, `r`.`fecha_resena` AS `fecha_resena`, `u`.`email` AS `email_usuario` FROM (`resenas` `r` join `usuarios` `u` on(`r`.`id_user` = `u`.`id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD PRIMARY KEY (`id_favorito`),
  ADD KEY `FK de user` (`id_user`),
  ADD KEY `FK de receta` (`id_receta`);

--
-- Indices de la tabla `opciones_votacion_semanal`
--
ALTER TABLE `opciones_votacion_semanal`
  ADD PRIMARY KEY (`id_opcion`);

--
-- Indices de la tabla `recetas`
--
ALTER TABLE `recetas`
  ADD PRIMARY KEY (`id_receta`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id_resenas`) USING BTREE,
  ADD KEY `Foreign Key receta` (`id_receta`),
  ADD KEY `Foreign Key resena` (`id_user`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_voto`),
  ADD KEY `Foreign Key voto` (`id_user`),
  ADD KEY `voto id_receta` (`id_receta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `favoritos`
--
ALTER TABLE `favoritos`
  MODIFY `id_favorito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `opciones_votacion_semanal`
--
ALTER TABLE `opciones_votacion_semanal`
  MODIFY `id_opcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recetas`
--
ALTER TABLE `recetas`
  MODIFY `id_receta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id_resenas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `votos`
--
ALTER TABLE `votos`
  MODIFY `id_voto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `FK de receta` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK de user` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `Foreign Key receta` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Foreign Key resena` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `votos`
--
ALTER TABLE `votos`
  ADD CONSTRAINT `Foreign Key voto` FOREIGN KEY (`id_user`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `voto id_receta` FOREIGN KEY (`id_receta`) REFERENCES `recetas` (`id_receta`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
