SELECT E.Clave, SUM(E.Cantidad) AS 'Suma de Cantidades', SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS "Importe Total"
FROM ENTREGAN E, Materiales M 
WHERE E.Clave = M.Clave AND E.Fecha >= '1997-01-01' AND E.FECHA < '1998-01-01'
GROUP BY E.Clave, E.Cantidad, M.Costo, M.PorcentajeImpuesto;

SELECT E.RFC, P.RazonSocial, COUNT(E.Cantidad) AS 'Número de Entregas', SUM((E.Cantidad * M.Costo)+((M.PorcentajeImpuesto*(E.Cantidad * M.Costo))/100)) AS "Importe Total"
FROM ENTREGAN E, PROVEEDORES P, MATERIALES M
WHERE E.RFC = P.RFC AND E.Clave = M.Clave
GROUP BY E.RFC, P.RazonSocial;

