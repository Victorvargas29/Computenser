-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para mydb
DROP DATABASE IF EXISTS `mydb`;
CREATE DATABASE IF NOT EXISTS `mydb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mydb`;

-- Volcando estructura para tabla mydb.categoria
DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de categorias',
  `nombre` varchar(30) NOT NULL COMMENT 'Nombre de categoria',
  `idDepartamento` int(11) NOT NULL COMMENT 'clave foranea que identifica la tabla departamentos',
  PRIMARY KEY (`idCategoria`),
  KEY `fk_Categoria_Departamento_idx` (`idDepartamento`),
  CONSTRAINT `fk_Categoria_Departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`iddepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.categoria: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` (`idCategoria`, `nombre`, `idDepartamento`) VALUES
	(1, 'Camiones', 1);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.cliente
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `cedula` varchar(15) NOT NULL COMMENT 'Cedula de identidad del cliente',
  `nombre` varchar(25) NOT NULL COMMENT 'Nombre de Cliente',
  `apellido` varchar(45) NOT NULL COMMENT 'Apellido del cliente',
  `direccion` varchar(250) DEFAULT NULL COMMENT 'Direccion del cliente',
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL COMMENT 'correo electronico del cliente',
  PRIMARY KEY (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.cliente: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`cedula`, `nombre`, `apellido`, `direccion`, `telefono`, `correo`) VALUES
	('V-123', 'Chin', 'Shampo', 'JF', '555555', 'chin@m.com');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.departamento
DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de los departamentos',
  `nombre` varchar(15) DEFAULT NULL COMMENT 'Nombre de departamentos',
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.departamento: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`idDepartamento`, `nombre`) VALUES
	(1, 'Taller');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detallefactura
DROP TABLE IF EXISTS `detallefactura`;
CREATE TABLE IF NOT EXISTS `detallefactura` (
  `IddetalleF` int(11) NOT NULL AUTO_INCREMENT,
  `idFactura` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tasa` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`IddetalleF`),
  KEY `idFactura` (`idFactura`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `FK2Factura` FOREIGN KEY (`idFactura`) REFERENCES `factura` (`idfactura`) ON UPDATE CASCADE,
  CONSTRAINT `FK2Servicio_Detallef` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idservicio`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.detallefactura: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `detallefactura` DISABLE KEYS */;
INSERT INTO `detallefactura` (`IddetalleF`, `idFactura`, `idServicio`, `precio`, `descripcion`, `tasa`, `cantidad`) VALUES
	(1, 2, 1, 200, 'descripcion de los realizado en la reparacion del camion. y mano de obra', 4.5, 2),
	(2, 3, 1, 200, 'motor camion', 24.98, 2),
	(3, 4, 1, 200, 'asdasdasdasdasdasdasdasd', 24.98, 10),
	(4, 5, 1, 200, 'dddd', 25.1, 2),
	(5, 6, 1, 200, 'dddd', 25.1, 1),
	(6, 7, 1, 200, 'dddd', 25.1, 2),
	(7, 8, 1, 200, 'dddd', 25.1, 2),
	(8, 9, 1, 200, '1414', 25.1, 1),
	(9, 10, 1, 200, '1414', 25.1, 1),
	(10, 11, 1, 200, 'dddd', 25.1, 14),
	(11, 12, 1, 200, 'dddd', 25.1, 1);
/*!40000 ALTER TABLE `detallefactura` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detallepresupuesto
DROP TABLE IF EXISTS `detallepresupuesto`;
CREATE TABLE IF NOT EXISTS `detallepresupuesto` (
  `IddetalleP` int(11) NOT NULL AUTO_INCREMENT,
  `idPresupuesto` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tasa` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  PRIMARY KEY (`IddetalleP`),
  KEY `idFactura` (`idPresupuesto`),
  KEY `idServicio` (`idServicio`),
  CONSTRAINT `FK2_servicio_detalle` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idservicio`),
  CONSTRAINT `FK_presupuesto_Detalle` FOREIGN KEY (`idPresupuesto`) REFERENCES `presupuesto` (`idpresupuesto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.detallepresupuesto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detallepresupuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallepresupuesto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detallesempleada_servicio
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
  CONSTRAINT `fk_Servicio_has_Empleada_Servicio_Empleada_Servicio1` FOREIGN KEY (`idPedido_Servicio`) REFERENCES `pedido_servicio` (`idpedido_servicio`),
  CONSTRAINT `fk_Servicio_has_Empleada_Servicio_Servicio1` FOREIGN KEY (`idServicio`) REFERENCES `servicio` (`idservicio`),
  CONSTRAINT `fk_detallesEmpleada_Servicio_Empleada1` FOREIGN KEY (`Empleada_cedula`) REFERENCES `empleada` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.detallesempleada_servicio: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detallesempleada_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallesempleada_servicio` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detallesfacturatemporal
DROP TABLE IF EXISTS `detallesfacturatemporal`;
CREATE TABLE IF NOT EXISTS `detallesfacturatemporal` (
  `iddetallesFT` int(11) NOT NULL AUTO_INCREMENT,
  `idFactura` int(11) DEFAULT NULL,
  `idServicio` int(11) DEFAULT NULL,
  `nombre_serv` varchar(200) DEFAULT NULL,
  `precioTemp` double DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tasa` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallesFT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.detallesfacturatemporal: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detallesfacturatemporal` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallesfacturatemporal` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.detallesinventario
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
  CONSTRAINT `fk_detallesInventario_inventario1` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`idinventario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.detallesinventario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `detallesinventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallesinventario` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.empleada
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
  CONSTRAINT `fk_Empleada_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.empleada: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empleada` DISABLE KEYS */;
/*!40000 ALTER TABLE `empleada` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.factura
DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `idFactura` int(11) NOT NULL COMMENT 'identificador de la tabla Factura',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha de Facturacion',
  `cedula` varchar(15) NOT NULL,
  `tipo_moneda` enum('0','1') NOT NULL,
  `anulado` enum('1','0') DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `oentrega` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idFactura`),
  KEY `fk_Servicio_Categoria` (`cedula`),
  CONSTRAINT `FK_factura_cliente` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.factura: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
INSERT INTO `factura` (`idFactura`, `fecha`, `cedula`, `tipo_moneda`, `anulado`, `placa`, `oentrega`) VALUES
	(1, '2021-11-03 19:26:11', 'V-123', '0', '0', '123', '123'),
	(2, '2021-11-03 19:59:04', 'V-123', '1', '0', 'asd', 'asd'),
	(3, '2023-02-08 21:10:19', 'V-123', '0', '0', '123vr', '123asf'),
	(4, '2023-02-08 21:21:20', 'V-123', '0', '1', '1asfq', '123d'),
	(5, '2023-02-15 13:18:03', 'V-123', '1', '0', '44', '14'),
	(6, '2023-02-15 16:15:50', 'V-123', '1', '0', '14', '444'),
	(7, '2023-02-15 16:18:05', 'V-123', '1', '0', '1212', '1212'),
	(8, '2023-02-15 16:22:43', 'V-123', '1', '0', '14', '41'),
	(9, '2023-02-15 16:23:45', 'V-123', '1', '0', '4', '14'),
	(10, '2023-02-15 16:24:42', 'V-123', '1', '0', '14', '14'),
	(11, '2023-02-15 16:25:24', 'V-123', '1', '0', '144', '14'),
	(12, '2023-02-15 16:26:45', 'V-123', '1', '0', '14', '41');
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.inventario
DROP TABLE IF EXISTS `inventario`;
CREATE TABLE IF NOT EXISTS `inventario` (
  `idInventario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de inventario',
  `cantidad` int(11) NOT NULL COMMENT 'Cantidad de productos (stock)',
  `idProducto` int(11) NOT NULL COMMENT 'identificado de la tabla producto que conecta la tabla producto con esta tabla',
  PRIMARY KEY (`idInventario`),
  KEY `fk_inventario_producto1` (`idProducto`),
  CONSTRAINT `fk_inventario_producto1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idproducto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.inventario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
INSERT INTO `inventario` (`idInventario`, `cantidad`, `idProducto`) VALUES
	(1, 2, 1);
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.inventario_departamento
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
  CONSTRAINT `fk_Inventario_has_Departamento_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `fk_Inventario_has_Departamento_Inventario1` FOREIGN KEY (`idInventario`) REFERENCES `inventario` (`idInventario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.inventario_departamento: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `inventario_departamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario_departamento` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.marca
DROP TABLE IF EXISTS `marca`;
CREATE TABLE IF NOT EXISTS `marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `name_marca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.marca: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.modelo
DROP TABLE IF EXISTS `modelo`;
CREATE TABLE IF NOT EXISTS `modelo` (
  `idModelo` int(11) NOT NULL AUTO_INCREMENT,
  `name_mode` varchar(50) DEFAULT NULL,
  `idMarca` int(11) DEFAULT NULL,
  PRIMARY KEY (`idModelo`),
  KEY `fk_idMarca` (`idMarca`),
  CONSTRAINT `fk_idMarca` FOREIGN KEY (`idMarca`) REFERENCES `marca` (`idMarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.modelo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `modelo` DISABLE KEYS */;
/*!40000 ALTER TABLE `modelo` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.moneda
DROP TABLE IF EXISTS `moneda`;
CREATE TABLE IF NOT EXISTS `moneda` (
  `idMoneda` int(11) DEFAULT NULL,
  `tipo` enum('0','1') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.moneda: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `moneda` DISABLE KEYS */;
/*!40000 ALTER TABLE `moneda` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.presentacionproducto
DROP TABLE IF EXISTS `presentacionproducto`;
CREATE TABLE IF NOT EXISTS `presentacionproducto` (
  `idPresentacionP` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador de esta tabla.',
  `nombre` varchar(10) NOT NULL COMMENT 'nombre de la presentacion',
  PRIMARY KEY (`idPresentacionP`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.presentacionproducto: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `presentacionproducto` DISABLE KEYS */;
INSERT INTO `presentacionproducto` (`idPresentacionP`, `nombre`) VALUES
	(1, '4454');
/*!40000 ALTER TABLE `presentacionproducto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.presupuesto
DROP TABLE IF EXISTS `presupuesto`;
CREATE TABLE IF NOT EXISTS `presupuesto` (
  `idPresupuesto` int(11) NOT NULL COMMENT 'identificador de la tabla Presupuesto',
  `fecha` datetime DEFAULT NULL COMMENT 'Fecha de creacion de Presupuesto',
  `cedula` varchar(15) NOT NULL,
  `tipo_moneda` enum('0','1') NOT NULL,
  `placa` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idPresupuesto`),
  KEY `fk_presupuesto` (`cedula`),
  CONSTRAINT `FK_presupuesto_cliente` FOREIGN KEY (`cedula`) REFERENCES `cliente` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.presupuesto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `presupuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `presupuesto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de producto',
  `nombre` varchar(150) NOT NULL COMMENT 'Nombre del Producto',
  `idDepartamento` int(11) NOT NULL COMMENT 'Clave foranea de tabla departamentos',
  `idPresentacionP` int(11) NOT NULL COMMENT 'identificador de la tabla presentacion del producto',
  `cantidadP` float NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `fk_Producto_Departamento1_idx` (`idDepartamento`),
  KEY `fk_producto_presentacionProducto1` (`idPresentacionP`),
  CONSTRAINT `fk_Producto_Departamento1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`),
  CONSTRAINT `fk_producto_presentacionProducto1` FOREIGN KEY (`idPresentacionP`) REFERENCES `presentacionproducto` (`idPresentacionP`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.producto: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`idProducto`, `nombre`, `idDepartamento`, `idPresentacionP`, `cantidadP`) VALUES
	(1, '', 1, 1, 15);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.servicio
DROP TABLE IF EXISTS `servicio`;
CREATE TABLE IF NOT EXISTS `servicio` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT COMMENT 'indentificador de servicios',
  `Nombre` varchar(200) NOT NULL COMMENT 'nombre de servicio',
  `Precio` double NOT NULL COMMENT 'precio del servicio',
  `idCategoria` int(11) NOT NULL COMMENT 'clave foranea que indentifica la tabla categoria',
  PRIMARY KEY (`idServicio`),
  KEY `fk_Servicio_Categoria1_idx` (`idCategoria`),
  CONSTRAINT `fk_Servicio_Categoria1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.servicio: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
INSERT INTO `servicio` (`idServicio`, `Nombre`, `Precio`, `idCategoria`) VALUES
	(1, 'Motor', 200, 1);
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.t_detallepresupuesto
DROP TABLE IF EXISTS `t_detallepresupuesto`;
CREATE TABLE IF NOT EXISTS `t_detallepresupuesto` (
  `id_tdetalle` int(11) NOT NULL AUTO_INCREMENT,
  `idPresupuesto` int(15) DEFAULT NULL,
  `idServicio` int(15) DEFAULT NULL,
  `nomb_serv` varchar(200) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `tasa` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_tdetalle`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla mydb.t_detallepresupuesto: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `t_detallepresupuesto` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_detallepresupuesto` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.usuario
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.usuario: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `email`, `tipo_usuario`, `password`, `estado`, `avatar`) VALUES
	(1, 'Edwin', 'Pacheco', 'pacheco@gmail.com', '1', '123', '1', '772784243.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

-- Volcando estructura para tabla mydb.vehiculo
DROP TABLE IF EXISTS `vehiculo`;
CREATE TABLE IF NOT EXISTS `vehiculo` (
  `idVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(15) DEFAULT NULL,
  `serial` int(11) DEFAULT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `idModelo` int(11) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `kms` int(11) DEFAULT NULL,
  `traccion` int(11) DEFAULT NULL,
  `cilindros` int(11) DEFAULT NULL,
  `gasolina` varchar(50) DEFAULT NULL,
  `name_chofer` varchar(50) DEFAULT NULL,
  `carnet_circula` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idVehiculo`),
  KEY `fk_client_vehic_indx` (`cedula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla mydb.vehiculo: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `vehiculo` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehiculo` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
