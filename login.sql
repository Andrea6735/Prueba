CREATE TABLE usuarios(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	correo VARCHAR(150) NOT NULL unique,
	PASSWORD VARCHAR(150) NOT null,
	RUT VARCHAR(10) NOT NULL
	
)