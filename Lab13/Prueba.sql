drop TABLE Entregan
drop TABLE Materiales
drop TABLE Proyectos
drop TABLE Proveedores


IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Materiales')


CREATE TABLE Materiales
(
  Clave numeric(5) not null,
  Descripcion varchar(50),
  Costo numeric (8,2)
)

BULK INSERT a1173530.a1173530.[Materiales]
   FROM 'e:\wwwroot\rcortese\materiales.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
	

SELECT  * FROM Materiales

INSERT INTO Materiales values(1000, 'xxx', 1000)
SELECT  * FROM Materiales

Delete from Materiales where Clave = 1000 and Costo = 1000

ALTER TABLE Materiales add constraint llaveMateriales PRIMARY KEY (Clave)

INSERT INTO Materiales values(1000, 'xxx', 1000)

sp_helpconstraint materiales




IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Proveedores')

CREATE TABLE Proveedores
(
  RFC char(13) not null,
  RazonSocial varchar(50)
)

ALTER TABLE Proveedores add constraint llaveProveedores PRIMARY KEY (RFC)

BULK INSERT a1173530.a1173530.[Proveedores]
   FROM 'e:\wwwroot\rcortese\Proveedores.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
	

SELECT  * FROM Proveedores



sp_helpconstraint proveedores





IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Proyectos')

CREATE TABLE Proyectos
(
  Numero numeric(5) not null,
  Denominacion varchar(50)
)

BULK INSERT a1173530.a1173530.[Proyectos]
   FROM 'e:\wwwroot\rcortese\Proyectos.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )
SELECT  * FROM Proyectos
	
ALTER TABLE Proyectos add constraint llaveProyectos PRIMARY KEY (Numero)


sp_helpconstraint proyectos






IF EXISTS (SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME = 'Entregan')

CREATE TABLE Entregan
(
  Clave numeric(5) not null,
  RFC char(13) not null,
  Numero numeric(5) not null,
  Fecha DateTime not null,
  Cantidad numeric (8,2)
)

 

ALTER TABLE Entregan
ADD CONSTRAINT llaveEntregan PRIMARY KEY (Fecha)



sp_helpconstraint entregan

SET DATEFORMAT dmy -- especificar formato de la fecha

BULK INSERT a1173530.a1173530.[Entregan]
   FROM 'e:\wwwroot\rcortese\Entregan.csv'
   WITH
      (
         CODEPAGE = 'ACP',
         FIELDTERMINATOR = ',',
         ROWTERMINATOR = '\n'
      )

SELECT  * FROM Entregan
