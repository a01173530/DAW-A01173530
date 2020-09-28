CREATE TABLE Materiales
(
  Clave numeric(5) not null PRIMARY KEY,
  Descripcion varchar(50),
  Costo numeric(8,2)
)

CREATE TABLE Proveedores
(
  RFC char(13) not null primary key,
  RazonSocial varchar(50),
  
)




CREATE TABLE Proyectos
(
  Numero numeric(5) not null primary key,
  Denominacion varchar(50),
)



CREATE TABLE Entregan 
(
  Clave numeric(5),
  RFC char(13),
  Numero numeric(5),
  Fecha datetime not null primary key,
  Cantidad numeric(8,2),

  FOREIGN KEY (Clave) REFERENCES Materiales(Clave),
  FOREIGN KEY (RFC) REFERENCES Proveedores(RFC),
  FOREIGN KEY (Numero) REFERENCES Proyectos(Numero)

)