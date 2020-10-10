
select * from materiales

select * from materiales
where clave=1000

select clave,rfc,fecha from entregan


select * from materiales,entregan
where materiales.clave = entregan.clave

select * from entregan,proyectos
where entregan.numero < = proyectos.numero


(select * from entregan where clave=1450)
union
(select * from entregan where clave=1300)


select * from entregan where clave=1450 or clave=1300

(select clave from entregan where numero=5001)
intersect
(select clave from entregan where numero=5018)

(select * from entregan)
minus
(select * from entregan where clave=1000)

(select * from entregan)
except
(select * from entregan where clave=1000)

select * from entregan,materiales

set dateformat dmy

select distinct * from entregan where  fecha Between  '01-JAN-2000' AND '31-DEC-2000'

select * descripcion from entregan,materiales where  fecha Between  '01-JAN-2000' AND '31-DEC-2000'

select  descripcion from materiales,entregan
where materiales.clave = entregan.clave and fecha Between  '01-JAN-2000' AND '31-DEC-2000'


select distinct descripcion from materiales,entregan
where materiales.clave = entregan.clave and fecha Between  '01-JAN-2000' AND '31-DEC-2000'


Materiales(Clave, Descripción, Costo)
Proveedores(RFC, RazonSocial)
Proyectos(Numero,Denominacion)
Entregan(Clave, RFC, Numero, Fecha, Cantidad)

Obtén los números y denominaciones de los proyectos con las fechas y cantidades de sus entregas, 
ordenadas por número de proyecto, presentando las fechas de la más reciente a la más antigua.


select denominacion,cantidad,fecha from proyectos, entregan
where  proyectos.numero = entregan.numero 
order by fecha desc


SELECT * FROM materiales where Descripcion LIKE 'Si%'

SELECT * FROM materiales where Descripcion LIKE 'Si'


DECLARE @foo varchar(40);
DECLARE @bar varchar(40);
SET @foo = '¿Que resultado';
SET @bar = ' ¿¿¿??? '
SET @foo += ' obtienes?';
PRINT @foo + @bar;

SELECT RFC FROM Entregan WHERE RFC LIKE '[A-D]%';
SELECT RFC FROM Entregan WHERE RFC LIKE '[^A]%';
SELECT Numero FROM Entregan WHERE Numero LIKE '___6';

SELECT RFC,Cantidad, Fecha,Numero
FROM [Entregan]
WHERE [Numero] Between 5000 and 5010 AND
Exists ( SELECT [RFC]
FROM [Proveedores]
WHERE RazonSocial LIKE 'La%' and [Entregan].[RFC] = [Proveedores].[RFC] )


SELECT RFC,Cantidad, Fecha,NumeroFROM [Entregan]WHERE [Numero] Between 5000 and 5010 AND RFC IN( SELECT [RFC] FROM [Proveedores] WHERE RazonSocial LIKE 'La%' and [Entregan].[RFC] =[Proveedores].[RFC] )



SELECT RFC,Cantidad, Fecha,Numero
FROM [Entregan] E
WHERE [Numero] Between 5000 and 5010 AND E.RFC NOT IN 
( SELECT [RFC] FROM [Proveedores] WHERE RazonSocial NOT LIKE 'La%')




SELECT TOP 2 * FROM Proyectos

SELECT TOP Numero * FROM Proyectos

ALTER TABLE materiales ADD PorcentajeImpuesto NUMERIC(6,2);

UPDATE materiales SET PorcentajeImpuesto = 2*clave/1000;


SELECT  SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS "Importe Total"
FROM Entregan E, Materiales M
WHERE  E.Clave = M.Clave




CREATE VIEW  RFC
FROM [Entregan] 


SELECT M.clave, M.descripcion
FROM  Materiales M, Entregan E
WHERE E.Clave = M.Clave and M.descripcion= 'México sin ti no estamos completos'


SELECT  M.clave, M.descripcion
FROM 	Materiales M, Entregan E, Proveedores Pr
WHERE  E.Clave = M.Clave and Pr.RFC= E.RFC and Pr.razonsocial= 'Acme tools'


SELECT E.RFC 
FROM  Entregan E
WHERE  cantidad >= 300 and E.fecha Between  '01-JAN-2000' AND '31-DEC-2000'


SELECT  SUM((E.Cantidad * M.Costo)) AS 'Total entregado'
FROM Entregan E, Materiales M
WHERE  E.Clave = M.Clave and E.fecha Between  '01-JAN-2000' AND '31-DEC-2000'


SELECT   M.descripcion, COUNT(E.Cantidad ) AS 'Total entregado'
FROM Entregan E, Materiales M
WHERE  E.Clave = M.Clave and E.fecha Between  '01-JAN-2000' AND '31-DEC-2000'
GROUP BY M.descripcion 



SELECT M.descripcion
FROM Materiales M
WHERE M.descripcion LIKE '%ub%' 

SELECT TOP 1 clave
FROM Entregan
WHERE fecha Between '01-JAN-2000' AND '31-DEC-2000'
ORDER BY cantidad DESC


SELECT clave,cantidad
FROM Entregan
WHERE fecha Between '01-JAN-2000' AND '31-DEC-2000'
ORDER BY cantidad DESC



SELECT  SUM((E.Cantidad * M.Costo)) AS 'Suma total de proyectos'
FROM Entregan E, Materiales M
WHERE  E.Clave = M.Clave and E.fecha Between  '01-JAN-2000' AND '31-DEC-2000'




SELECT P.denominacion,  SUM((E.Cantidad * M.Costo)) AS 'Suma total de proyectos'
FROM Entregan E, Materiales M, Proyectos P
WHERE  E.Clave = M.Clave and  P.numero= E.numero  
Group BY P.denominacion


SELECT M.descripcion, COUNT(E.Cantidad) AS 'Cantidad de veces',  SUM((E.Cantidad * M.Costo)) AS 'Suma total de proyectos'
FROM Entregan E, Materiales M, Proyectos P
WHERE  E.Clave = M.Clave and  P.numero= E.numero  
Group BY M.descripcion


SELECT M.descripcion, M.costo
FROM Entregan E, Materiales M, Proyectos P 
WHERE  E.Clave = M.Clave and  P.numero= E.numero and  Denominacion= 'Televisa en acción'
Union 
SELECT M.descripcion, M.costo
FROM Entregan E, Materiales M, Proyectos P 
WHERE E.Clave = M.Clave and  P.numero= E.numero and  Denominacion= 'Educando en Coahuila'



CREATE VIEW vista1
AS SELECT  SUM((E.Cantidad * M.Costo)) AS 'Suma total de proyectos'
   FROM Entregan E, Materiales M
   WHERE  E.Clave = M.Clave and E.fecha Between  '01-JAN-2000' AND '31-DEC-2000'


select * FROM vista1


Materiales(Clave, Descripción, Costo)
Proveedores(RFC, RazonSocial)
Proyectos(Numero,Denominacion)
Entregan(Clave, RFC, Numero, Fecha, Cantidad)






SELECT P.denominacion, Pr.RFC,Pr.razonsocial
FROM Entregan E, Proyectos P, Proveedores Pr, Materiales M
WHERE Pr.RFC= E.RFC and P.numero=E.numero and M.clave= E.clave  AND P.denominacion NOT IN 
( SELECT P.denominacion FROM Proyectos P WHERE P.denominacion NOT LIKE 'Televisa en acción')
except
SELECT P.denominacion, Pr.RFC,Pr.razonsocial
FROM Entregan E, Proyectos P, Proveedores Pr, Materiales M
WHERE Pr.RFC= E.RFC and P.numero=E.numero and M.clave= E.clave  AND P.denominacion NOT IN 
( SELECT P.denominacion FROM Proyectos P WHERE P.denominacion NOT LIKE 'Educando en Coahuila')



CREATE VIEW solovista1
AS SELECT P.denominacion, Pr.RFC, Pr.razonSocial
   FROM Proveedores Pr, Entregan E, Proyectos P
   WHERE Pr.RFC= E.RFC and P.numero=E.numero and   P.denominacion= 'Televisa en acción' 
 


   CREATE VIEW solovista2
AS SELECT P.denominacion, Pr.RFC, Pr.razonSocial
   FROM Proveedores Pr, Entregan E, Proyectos P
   WHERE Pr.RFC= E.RFC and P.numero=E.numero and  P.denominacion= 'Educando en Coahuila'
 

(select * FROM solovista1)
except
(select * FROM solovista2)




