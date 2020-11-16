CREATE TABLE Cliente (
	noCuenta varchar(5) PRIMARY KEY,
	Nombre varchar(30),
	Saldo numeric(10,2)

)

CREATE TABLE Movimiento (
	ClaveM varchar(2) PRIMARY KEY,
	Descripcion varchar(30),
	
)
CREATE TABLE Cliente_movimiento (
	
	noCuenta varchar(5),
	ClaveM varchar(2),
	fecha varchar(30),
	Saldo numeric(10,2),

	CONSTRAINT PK_cuenta_clave PRIMARY KEY (noCuenta,ClaveM,fecha),
	CONSTRAINT FK_cliente_noCuenta FOREIGN KEY (noCuenta) REFERENCES Cliente(noCuenta),
	CONSTRAINT FK_movimiento_Clave FOREIGN KEY (ClaveM) REFERENCES Movimiento(ClaveM)

)

update Cliente_movimientor SET nombre 

BEGIN TRANSACTION PRUEBA1
INSERT INTO CLIENTE VALUES('001', 'Manuel Rios Maldonado', 9000);
INSERT INTO CLIENTE VALUES('002', 'Pablo Perez Ortiz', 5000);
INSERT INTO CLIENTE VALUES('003', 'Luis Flores Alvarado', 8000);
COMMIT TRANSACTION PRUEBA1

BEGIN TRANSACTION PRUEBA2
INSERT INTO CLIENTE VALUES('004','Ricardo Rios Maldonado',19000);
INSERT INTO CLIENTE VALUES('005','Pablo Ortiz Arana',15000);
INSERT INTO CLIENTE VALUES('006','Luis Manuel Alvarado',18000);



BEGIN TRANSACTION PRUEBA3
INSERT INTO MOVIMIENTO VALUES('A','Retiro Cajero Automatico');
INSERT INTO MOVIMIENTO VALUES('B','Deposito Ventanilla');
COMMIT TRANSACTION PRUEBA3


BEGIN TRANSACTION PRUEBA4
INSERT INTO Cliente_movimiento VALUES('001','A',GETDATE(),500);
UPDATE CLIENTE SET SALDO = SALDO -500
WHERE NoCuenta='001'
COMMIT TRANSACTION PRUEBA4

BEGIN TRANSACTION PRUEBA5
INSERT INTO CLIENTE VALUES('005','Rosa Ruiz Maldonado',9000);
INSERT INTO CLIENTE VALUES('006','Luis Camino Ortiz',5000);
INSERT INTO CLIENTE VALUES('001','Oscar Perez Alvarado',8000);


IF @@ERROR = 0
COMMIT TRANSACTION PRUEBA5
ELSE
BEGIN
PRINT 'A transaction needs to be rolled back'
ROLLBACK TRANSACTION PRUEBA5
END

CREATE PROCEDURE REGISTRAR_RETIRO_CAJERO
	@unoCuenta  varchar(5),
	@umontoRetiro numeric(10,2)

AS
	BEGIN TRANSACTION RETIRO
	INSERT INTO Cliente_movimiento VALUES(@unoCuenta,'A',GETDATE(),@umontoRetiro);
	UPDATE Cliente SET SALDO = SALDO -@umontoRetiro WHERE noCuenta = @unoCuenta
	COMMIT TRANSACTION RETIRO
GO


EXECUTE REGISTRAR_RETIRO_CAJERO'004',500

SELECT * FROM CLIENTE WHERE noCuenta='001'

COMMIT TRANSACTION PRUEBA1

ROLLBACK TRANSACTION PRUEBA2

SELECT * FROM Cliente_movimiento





CREATE PROCEDURE REGISTRAR_DEPOSITO_VENTANILLA
	@unoCuenta  varchar(5),
	@umontoDeposito numeric(10,2)

AS
	BEGIN TRANSACTION RETIRO
	INSERT INTO Cliente_movimiento VALUES(@unoCuenta,'B',GETDATE(),@umontoDeposito);
	UPDATE Cliente SET SALDO = SALDO +@umontoDeposito WHERE noCuenta = @unoCuenta
	COMMIT TRANSACTION RETIRO
GO

EXECUTE REGISTRAR_DEPOSITO_VENTANILLA'001',5000r