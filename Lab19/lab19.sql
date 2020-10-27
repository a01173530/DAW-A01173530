
--La suma de las cantidades e importe total de todas las entregas realizadas durante el 97.
SET DATEFORMAT dmy
SELECT E.Clave, SUM(E.Cantidad) AS 'Suma de Cantidades', SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS 'Importe total'
FROM Entregan E, Materiales M 
WHERE E.Clave = M.Clave AND E.Fecha >= '01/01/1997' AND E.FECHA < '01/01/1998' 
GROUP BY E.Clave, E.Cantidad, M.Costo, M.PorcentajeImpuesto

-- Para cada proveedor, obtener la razón social del proveedor, número de entregas e importe total de las entregas realizadas.
SELECT E.RFC, P.RazonSocial, COUNT(E.Cantidad) AS 'Número de entregas', SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS 'Importe total'
FROM ENTREGAN E, PROVEEDORES P, MATERIALES M
WHERE E.RFC = P.RFC AND E.Clave = M.Clave
GROUP BY E.RFC, P.RazonSocial

--Por cada material obtener la clave y descripción del material, la cantidad total entregada, la mínima cantidad entregada, la máxima cantidad entregada, 
--el importe total de las entregas de aquellos materiales en los que la cantidad promedio entregada sea mayor a 400.

SELECT E.Clave, M.Descripcion, SUM(E.Cantidad) AS 'Cantidad total entregada', MIN(E.Cantidad) AS 'Mínima cantidad entregada', MAX(E.Cantidad) AS 'Máxima cantidad entregada', SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS 'Importe Total'
FROM Entregan E, Materiales M
GROUP BY E.Clave, M.Descripcion
HAVING AVG(E.Cantidad) > 400

--Para cada proveedor, indicar su razón social y mostrar la cantidad promedio de cada material entregado, detallando la clave y descripción del material, 
--excluyendo aquellos proveedores para los que la cantidad promedio sea menor a 500.

SELECT P.RazonSocial, AVG(E.Cantidad) AS 'Promedio de cada material entregado', M.Clave, M.Descripcion
FROM Proveedores P, Materiales M, Entregan E
WHERE P.RFC = E.RFC AND M.Clave = E.Clave
GROUP BY P.RazonSocial, M.Clave, M.Descripcion
HAVING AVG(E.Cantidad) >= 500


-- Mostrar en una solo consulta los mismos datos que en la consulta anterior pero para dos grupos de proveedores: 
--aquellos para los que la cantidad promedio entregada es menor a 370 
--y aquellos para los que la cantidad promedio entregada sea mayor a 450.

SELECT P.RazonSocial, M.Clave, M.Descripcion, AVG(E.Cantidad) AS 'Promedio por Mterial'
FROM Proveedores P, Materiales M, Entregan E
WHERE P.RFC = E.RFC AND M.Clave = E.Clave
GROUP BY P.RazonSocial, M.Clave, M.Descripcion
HAVING AVG(E.Cantidad) < 370 OR AVG(E.Cantidad) > 450


--Considerando que los valores de tipos CHAR y VARCHAR deben ir encerrados entre apóstrofes, los valores numéricos se escriben directamente y los de fecha, 
--como '1-JAN-00' para 1o. de enero del 2000, inserta cinco nuevos materiales.
select * from Materiales

INSERT INTO Materiales VALUES (1450,'Semento cruz azul', 170, 2.88)
INSERT INTO Materiales VALUES (1455,'Semento Pumas', 160, 2.9)
INSERT INTO Materiales VALUES (1460,'Concreto diamante', 160, 2.89)
INSERT INTO Materiales VALUES (1465,'Tuberia Mario bros', 170, 2.94)
INSERT INTO Materiales VALUES (1470,'Semento chivas', 180, 2.93)

--Clave y descripción de los materiales que nunca han sido entregados.
SELECT M.Clave, M.Descripcion
FROM Materiales M
WHERE M.Clave NOT IN (SELECT Clave FROM ENTREGAN)


--Razón social de los proveedores que han realizado entregas tanto al proyecto 'Vamos México' como al proyecto 'Querétaro Limpio'.

(SELECT P.RazonSocial
FROM Proveedores P, Proyectos Pr, Entregan E
WHERE P.RFC = E.RFC AND Pr.Numero = E.Numero AND E.Numero IN (SELECT Numero FROM Proyectos WHERE Denominacion = 'Vamos Mexico'))
UNION
(SELECT P.RazonSocial
FROM Proveedores P, Proyectos Pr, Entregan E
WHERE P.RFC = E.RFC AND Pr.Numero = E.Numero AND E.Numero IN (SELECT Numero FROM Proyectos WHERE Denominacion = 'Queretaro limpio'))


--Descripción de los materiales que nunca han sido entregados al proyecto 'CIT Yucatán'.
SELECT Descripcion
FROM Materiales 
WHERE Clave NOT IN (SELECT E.Clave FROM Proyectos Pr, Entregan E WHERE Pr.Numero = E.Numero AND Pr.Denominacion = 'CIT Yucatan')


--Razón social y promedio de cantidad entregada de los proveedores cuyo promedio de 
--cantidad entregada es mayor al promedio de la cantidad entregada por el proveedor con el RFC 'VAGO780901'.

SELECT P.RazonSocial, AVG(E.Cantidad) AS 'Promedio de la cantidad entregada'
FROM Entregan E, Proyectos Pr, Proveedores P
WHERE Pr.Numero = E.Numero AND P.RFC = E.RFC
GROUP BY P.RazonSocial
HAVING AVG(E.Cantidad) > (SELECT AVG(Cantidad) FROM ENTREGAN WHERE RFC='VAGO780901' GROUP BY RFC)


--RFC, razón social de los proveedores que participaron en el proyecto 'Infonavit Durango' 
--y cuyas cantidades totales entregadas en el 2000 fueron mayores a las cantidades totales entregadas en el 2001.


SET DATEFORMAT dmy
SELECT P.RFC, P.RazonSocial
FROM Entregan E, Proyectos Pr, Proveedores P
WHERE Pr.Numero = E.Numero AND P.RFC = E.RFC AND Pr.Denominacion ='Infonavit Durango'
GROUP BY P.RFC, P.RazonSocial HAVING 
(SELECT SUM(E.Cantidad) FROM Entregan E, Proyectos Pr, Proveedores  P WHERE Pr.Numero = E.Numero AND P.RFC = E.RFC AND (E.Fecha BETWEEN '01/01/2000' AND '31/12/2000')) 
> 
(SELECT SUM(E.Cantidad) FROM Entregan E, Proyectos Pr, Proveedores  P WHERE Pr.Numero = E.Numero AND P.RFC = E.RFC AND (E.Fecha BETWEEN '01/01/2001' AND '31/12/2001'))
