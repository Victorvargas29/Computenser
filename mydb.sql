-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mydb
DROP DATABASE IF EXISTS `mydb`;
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `mydb`;

-- Dumping structure for table mydb.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de categorias',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre de categoria',
  `idDepartamento` int(11) NOT NULL COMMENT 'clave foranea que identifica la tabla departamentos',
  PRIMARY KEY (`idCategoria`),
  KEY `fk_Categoria_Departamento_idx` (`idDepartamento`),
  CONSTRAINT `fk_Categoria_Departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cedula` varchar(15) NOT NULL COMMENT 'Cedula de identidad del cliente',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre de Cliente',
  `apellido` varchar(45) NOT NULL COMMENT 'Apellido del cliente',
  `direccion` varchar(45) DEFAULT NULL COMMENT 'Direccion del cliente',
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL COMMENT 'correo electronico del cliente',
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.departamento
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de los departamentos',
  `nombre` varchar(15) DEFAULT NULL COMMENT 'Nombre de departamentos',
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.detallefactura
DROP TABLE IF EXISTS `detallefactura`;
CREATE TABLE IF NOT EXISTS `detallefactura` (
  `IddetalleF` int(11) NOT NULL AUTO_INCREMENT,
  `idFactura` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  PRIMARY KEY (`IddetalleF`),
  KEY `idFactura` (`idFactura`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `FK1Factura_Detalle` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK2Servicio_Detallef` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table mydb.detallesempleada_servicio
DROP TABLE IF EXISTS `detallesempleada_servicio`;
CREATE TABLE IF NOT EXISTS `detallesempleada_servicio` (
  `id_detalles` int(11) NOT NULL AUTO_INCREMENT,
  `precio_dia` float NOT NULL COMMENT 'precio del servicio al momento de asignar el servicio a la empleada',
  `idServicio` int(11) NOT NULL,
  `idPedido_Servicio` int(11) NOT NULL,
  `Empleada_cedula` varchar(15) NOT NULL,
  PRIMARY KEY (`id_detalles`),
  KEY `fk_Servicio_has_Empleada_Servicio_Empleada_Servicio1_idx` (`idPedido_Servicio`),
  KEY `fk_Servicio_has_Empleada_Servicio_Servicio1_idx` (`idServicio`),
  KEY `fk_detallesEmpleada_Servicio_Empleada1_idx` (`Empleada_cedula`),
  CONSTRAINT `fk_Servicio_has_Empleada_Servicio_Empleada_Servicio1` FOREIGN KEY (`idPedido_Servicio`) REFERENCES `pedido_servicio` (`idPedido_Servicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Servicio_has_Empleada_Servicio_Servicio1` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idServicio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_detallesEmpleada_Servicio_Empleada1` FOREIGN KEY (`Empleada_cedula`) REFERENCES `empleada` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.detallesfacturatemporal
DROP TABLE IF EXISTS `detallesfacturatemporal`;
CREATE TABLE IF NOT EXISTS `detallesfacturatemporal` (
  `iddetallesFT` int(11) NOT NULL AUTO_INCREMENT,
  `idFactura` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `nombre_serv` varchar(50) DEFAULT NULL,
  `precioTemp` float DEFAULT NULL,
  `tasa` float DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallesFT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table mydb.detallesinventario
DROP TABLE IF EXISTS `detallesinventario`;
CREATE TABLE IF NOT EXISTS `detallesinventario` (
  `idDetalles` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL COMMENT 'Fecha en que se modifico mercancia',
  `idInventario` int(11) NOT NULL COMMENT 'identificador foraneo que conecta con inventario',
  `cantidadantigua` int(11) NOT NULL COMMENT 'cantidad que habia en el inverntario ante de ingresar nueva mercancia',
  `movimiento` int(11) NOT NULL COMMENT 'cantidad de producto que se realizo el movimiento\n',
  `estado` varchar(6) NOT NULL COMMENT 'estado del movimiento mas o menos',
  PRIMARY KEY (`idDetalles`),
  KEY `fk_detallesInventario_inventario1` (`idInventario`),
  CONSTRAINT `fk_detallesInventario_inventario1` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`idInventario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table mydb.empleada
DROP TABLE IF EXISTS `empleada`;
CREATE TABLE IF NOT EXISTS `empleada` (
  `cedula` varchar(15) NOT NULL COMMENT 'Cedula de identidad de la empleada',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la empleada',
  `apellido` varchar(45) NOT NULL COMMENT 'Apellido de la empleada',
  `fecha_ingreso` date NOT NULL COMMENT 'Fecha de ingreso al SPA',
  `telefono` varchar(45) DEFAULT NULL COMMENT 'Telefono de la empleada',
  `direccion` varchar(45) DEFAULT NULL COMMENT 'Direccion de la empleada',
  `email` varchar(45) DEFAULT NULL COMMENT 'correo de la empleada',
  `idDepartamento` int(11) NOT NULL COMMENT 'Clave foranea de tabla departamento',
  PRIMARY KEY (`cedula`),
  KEY `fk_Empleada_Departamento1_idx` (`idDepartamento`),
  CONSTRAINT `fk_Empleada_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.factura
DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de la tabla Factura',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha de Facturacion',
  `cedula` varchar(15) NOT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `fk_Servicio_Categoria` (`cedula`),
  CONSTRAINT `fk_Cliente_Factura` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.inventario
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `idInventario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de inventario',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad de productos (stock)',
  `idProducto` int(11) NOT NULL COMMENT 'identificado de la tabla producto que conecta la tabla producto con esta tabla',
  PRIMARY KEY (`idInventario`),
  KEY `fk_inventario_producto1` (`idProducto`),
  CONSTRAINT `fk_inventario_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.inventario_departamento
DROP TABLE IF EXISTS `inventario_departamento`;
CREATE TABLE IF NOT EXISTS `inventario_departamento` (
  `idInventarioDepa` int(11) NOT NULL AUTO_INCREMENT,
  `idInventario` int(11) NOT NULL COMMENT 'Clave foranea que identifica la tabla Inventario',
  `idDepartamento` int(11) NOT NULL COMMENT 'Clave foranea que identifica la tabla Departamentos',
  `fechaInicio` date NOT NULL COMMENT 'Fecha en que inicio el uso del producto',
  `fechaTermina` date DEFAULT NULL COMMENT 'fecha en que se termino el producto',
  PRIMARY KEY (`idInventarioDepa`),
  KEY `fk_Inventario_has_Departamento_Departamento1_idx` (`idDepartamento`),
  KEY `fk_Inventario_has_Departamento_Inventario1_idx` (`idInventario`),
  CONSTRAINT `fk_Inventario_has_Departamento_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inventario_has_Departamento_Inventario1` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`idInventario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.pedido_servicio
DROP TABLE IF EXISTS `pedido_servicio`;
CREATE TABLE IF NOT EXISTS `pedido_servicio` (
  `idPedido_Servicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de table Empleada_Servicio',
  `Fecha_Servicio` date NOT NULL COMMENT 'Fecha en que se realizo el servicio',
  `Cliente_cedula` varchar(15) NOT NULL,
  `idFactura` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPedido_Servicio`),
  KEY `fk_Empleada_Servicio_Cliente1_idx` (`Cliente_cedula`),
  KEY `fk_pedido_Servicio_factura1_idx` (`idFactura`),
  CONSTRAINT `fk_Empleada_Servicio_Cliente1` FOREIGN KEY (`Cliente_cedula`) REFERENCES `cliente` (`cedula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_Servicio_factura1` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idFactura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.presentacionproducto
DROP TABLE IF EXISTS `presentacionproducto`;
CREATE TABLE IF NOT EXISTS `presentacionproducto` (
  `idPresentacionP` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de esta tabla.',
  `nombre` varchar(10) NOT NULL COMMENT 'nombre de la presentacion',
  PRIMARY KEY (`idPresentacionP`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.
-- Dumping structure for table mydb.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de producto',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre del Producto',
  `idDepartamento` int(11) NOT NULL COMMENT 'Clave foranea de tabla departamentos',
  `idPresentacionP` int(11) NOT NULL COMMENT 'identificador de la tabla presentacion del producto',
  `cantidadP` float NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `fk_Producto_Departamento1_idx` (`idDepartamento`),
  KEY `fk_producto_presentacionProducto1` (`idPresentacionP`),
  CONSTRAINT `fk_Producto_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_presentacionProducto1` FOREIGN KEY (`idPresentacionP`) REFERENCES `presentacionproducto` (`idPresentacionP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.servicio
DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'indentificador de servicios',
  `Nombre` varchar(15) NOT NULL COMMENT 'nombre de servicio',
  `Precio` float NOT NULL COMMENT 'precio del servicio',
  `idCategoria` int(11) NOT NULL COMMENT 'clave foranea que indentifica la tabla categoria',
  PRIMARY KEY (`idServicio`),
  KEY `fk_Servicio_Categoria1_idx` (`idCategoria`),
  CONSTRAINT `fk_Servicio_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table mydb.usuario
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificado de Usuario',
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de Usuario',
  `apellido` varchar(45) NOT NULL COMMENT 'Apellido de Usuario',
  `email` varchar(45) NOT NULL COMMENT 'Correo de Usuario',
  `tipo_usuario` enum('0','1') NOT NULL COMMENT 'Tipos Administrador/Empleada (Privilegios)',
  `password` varchar(45) NOT NULL COMMENT 'Contraseña de usuario',
  `estado` enum('0','1') NOT NULL COMMENT 'estado activo/inactivo',
  `avatar` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
