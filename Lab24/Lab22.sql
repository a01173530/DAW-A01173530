select* from Cliente

Select* from Cliente_movimiento

select * from Movimiento


SELECT * FROM CLIENTE where NoCuenta='001'



CREATE PROCEDURE REGISTRAR_RETIRO_CAJERO	@unoCuenta  varchar(5),	@umontoRetiro numeric(10,2)AS	BEGIN TRANSACTION RETIRO	INSERT INTO Cliente_movimiento VALUES(@unoCuenta,'A',GETDATE(),@umontoRetiro);	UPDATE Cliente SET SALDO = SALDO -@umontoRetiro WHERE noCuenta = @unoCuenta	COMMIT TRANSACTION RETIROGO



DROP PROCEDURE IF EXISTS 'REGISTRAR_DEPOSITO_VENTANILLA'CREATE PROCEDURE `REGISTRAR_DEPOSITO_VENTANILLA` (uNoCuenta VARCHAR(5), uMonto DECIMAL (10,2))BEGIN INSERT INTO Movimiento VALUES (uNoCuenta, 'B', date(), uMonto);COMMIT ; END //DELIMITER ;
