           
		   
		   IF EXISTS (SELECT name FROM sysobjects
                       WHERE name = 'creaMaterial' AND type = 'P')
                DROP PROCEDURE creaMaterial
            GO

            CREATE PROCEDURE creaMaterial
                @uclave NUMERIC(5,0),
                @udescripcion VARCHAR(50),
                @ucosto NUMERIC(8,2),
                @uimpuesto NUMERIC(6,2)
            AS
                INSERT INTO Materiales VALUES(@uclave, @udescripcion, @ucosto, @uimpuesto)
            GO

			select * from Materiales

			EXECUTE creaMaterial 5000,'Martillos Acme',250,15


--modificaMaterial que permite modificar un material que reciba como parámetros las columnas de la tabla materiales y actualice las columnas correspondientes con los valores recibidos, para el registro cuya llave sea la clave que se recibe como parámetro.


			IF EXISTS (SELECT name FROM sysobjects WHERE name = 'modificaMaterial' AND type = 'P')
			DROP PROCEDURE modificaMaterial
			GO
			CREATE PROCEDURE modificaMaterial
			@uclave NUMERIC(5,0),
			@udescripcion VARCHAR(50),
			@ucosto NUMERIC(8,2),
			@uimpuesto NUMERIC(6,2)
			AS
			UPDATE Materiales SET clave = @uclave, descripcion = @udescripcion, costo = @ucosto, PorcentajeImpuesto = @uimpuesto
			GO

--eliminaMaterial que elimina el registro de la tabla materiales cuya llave sea la clave que se recibe como parámetro.

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'eliminaMaterial' AND type = 'P')
DROP PROCEDURE eliminaMaterial
GO
CREATE PROCEDURE eliminaMaterial
	@uclave NUMERIC(5,0)
AS
	DELETE FROM Materiales WHERE clave = @uclave
GO


--Desarrollar los procedimientos (almacenados) creaProyecto , modificaproyecto y eliminaproyecto, hacer lo mismo para las tablas proveedores y entregan.

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'creaProyectos' AND type = 'P')
DROP PROCEDURE creaProyecto
GO

CREATE PROCEDURE creaProyecto
	@uNumero NUMERIC(5),
	@uDenominacion VARCHAR(50)
AS
	INSERT INTO Proyectos VALUES(@uNumero, @uDenominacion)
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'modificaProyectos' AND type = 'P')
DROP PROCEDURE modificaMaterial
GO

CREATE PROCEDURE modificaProyectos
	@uNumero NUMERIC(5),
	@uDenominacion VARCHAR(50)
AS
	UPDATE Proyectos SET numero = @uNumero, Denominacion = @uDenominacion WHERE numero = @uNumero
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'eliminaProyectos' AND type = 'P')
DROP PROCEDURE eliminaProyectos
GO

CREATE PROCEDURE eliminaProyectos
	@uNumero NUMERIC(5)
AS
	DELETE FROM Proyectos WHERE numero = @uNumero
GO




---------------------------------

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'creaProveedores' AND type = 'P')
DROP PROCEDURE creaProveedores
GO

CREATE PROCEDURE creaProveedores
	@uRFC CHAR(13),
	@uRazonSocial VARCHAR(50)
AS
	INSERT INTO Proveedores VALUES(@uRFC, @uRazonSocial)
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'modificaProveedores' AND type = 'P')
DROP PROCEDURE modificaProveedores
GO

CREATE PROCEDURE modificaProveedores
	@uRFC CHAR(13),
	@uRazonSocial VARCHAR(50)
AS
	UPDATE Proveedores SET RFC = @uRFC, RazonSocial = @uRazonSocial WHERE RFC = @uRFC
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'eliminaProveedores' AND type = 'P')
DROP PROCEDURE eliminaProveedores
GO

CREATE PROCEDURE eliminaProveedores
	@uRFC CHAR(13)
AS
	DELETE FROM Proveedores WHERE RFC = @uRFC
GO



------------------------


IF EXISTS (SELECT name FROM sysobjects WHERE name = 'creaEntrega' AND type = 'P')
DROP PROCEDURE creaEntrega
GO

CREATE PROCEDURE creaEntrega
	@uClave NUMERIC(5),
	@uRFC CHAR(13),
	@uNumero NUMERIC(5),
	@uFecha DATETIME,
	@uCantidad NUMERIC(8,2)
AS
	INSERT INTO Entregan VALUES(@uClave, @uRFC, @uNumero, @uFecha, @uCantidad)
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'modificaEntrega' AND type = 'P')
DROP PROCEDURE modificaEntrega
GO

CREATE PROCEDURE modificaEntrega
	@uClave NUMERIC(5),
	@uRFC CHAR(13),
	@uNumero NUMERIC(5),
	@uFecha DATETIME,
	@uCantidad NUMERIC(8,2)
AS
	UPDATE Entregan SET clave = @uclave, RFC = @uRFC, numero = @uNumero, fecha = @uFecha, cantidad = @uCantidad WHERE clave = @uclave AND RFC = @uRFC AND Numero = @uNumero AND Fecha = @uFecha
GO

IF EXISTS (SELECT name FROM sysobjects WHERE name = 'eliminaEntrega' AND type = 'P')
DROP PROCEDURE eliminaEntrega
GO

CREATE PROCEDURE eliminaEntrega
	@uClave NUMERIC(5),
	@uRFC CHAR(13),
	@uNumero NUMERIC(5),
	@uFecha DATETIME
AS
	DELETE FROM Entregan WHERE clave = @uclave AND RFC = @uRFC AND numero = @uNumero AND fecha = @uFecha 
GO

----------------------------------------------------------------------------------
                           IF EXISTS (SELECT name FROM sysobjects
                                WHERE name = 'queryMaterial' AND type = 'P')
                                DROP PROCEDURE queryMaterial
                            GO

                            CREATE PROCEDURE queryMaterial
                                @udescripcion VARCHAR(50),
                                @ucosto NUMERIC(8,2)

                            AS
                                SELECT * FROM Materiales WHERE descripcion
                                LIKE '%'+@udescripcion+'%' AND costo > @ucosto
                            GO

							EXECUTE queryMaterial 'Lad',20