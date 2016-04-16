<?php class QR{

		const CONSULTA_DATOS_USUARIO="SELECT * FROM USER WHERE id=?";
		const CONSULTA_DATOS_PROYECTO="SELECT * FROM PROYECTO WHERE id=?";
		const CONSULTA_DATOS_FASE="SELECT * FROM FASE WHERE id=?";
		const CONSULTA_DATOS_TAREA="SELECT * FROM TAREA WHERE id=?";

		const CONSULTA_PROYECTO_TODOS="SELECT * FROM PROYECTO";
		const CONSULTA_USER_PROYECTO="SELECT * FROM USER_PROYECTO WHERE id_proyecto=?";

	//Contar proyectos
		const CONTAR_PROYECTOS="SELECT COUNT(ID) from proyecto";
	//Datos user-session/proyecto
		const CONSULTA_SESSION_PROYECTO="SELECT * FROM USER_PROYECTO WHERE id_user=?";
		//Contar proyectos en los que el usuario es admin
		const CONTAR_SESSION_PROYECTOS="SELECT COUNT(id_proyecto) FROM user_proyecto where id_user=? and id_rango=?";
		//Todos los datos user-session/proyecto
			const CONSULTA_VIEW_SESSION_PROYECTO="SELECT * FROM user_proyecto_view WHERE id_proyecto=? ORDER BY id_rango";

	//Fases de un proyecto
		const CONSULTA_FASES="SELECT * FROM FASE WHERE proyecto=?";
		//Contar fases
			const CONTAR_FASES="SELECT COUNT(ID) FROM FASE WHERE proyecto=?";
		//Tareas de un proyecto
			const CONSULTA_TAREAS="SELECT * FROM TAREA WHERE id_proyecto=? AND id_status=? ORDER BY fase AND id_status";
		//Contar tareas
			const CONTAR_TAREAS="SELECT COUNT(ID) FROM TAREA WHERE id_proyecto=?";

	//Verificar usuario: antes de login
		const CONSULTA_USUARIO="SELECT * FROM USER WHERE nick=? AND pass=?";

	//Comprobar si existe usuario: antes del registro
		const CONSULTA_USUARIO_EXISTE="SELECT * FROM USER WHERE nick=?";
	//Insertar usuario: registro
		const INSERTAR_USUARIO="INSERT INTO `USER`(`id`, `nick`, `email`, `pass`) VALUES (?,?,?,?)";
	//Contar usuarios: necesario para crear id_registro
		const CONTAR_USUARIOS="SELECT COUNT(id) FROM USER"; 

//INSERTAR DATOS
		//Nuevo proyecto
		const INSERTAR_PROYECTO="INSERT INTO PROYECTO (id,title,descripcion,fechaLimit) VALUES (?,?,?,?)";
				const INSERTAR_USER_PROYECTO="INSERT INTO USER_PROYECTO (id_proyecto,id_user,id_rango) VALUES (?,?,?)";
					const INSERTAR_FASE="INSERT INTO FASE(proyecto, id, title, descripcion) VALUES (?,?,?,?)";
			//Cargar usuarios para añadir como colaboradores
			//no llamar al que llama a la función
			const ALL_USERS_EXCALLER="SELECT * FROM USER WHERE ID NOT IN(?)";
			
		//Nueva tarea
		const INSERTAR_TAREA="INSERT INTO TAREA (fase,id_proyecto,id,id_status,title,descripcion) VALUES (?,?,?,?,?,?)";


//ELIMINAR DATOS
		//Eliminar proyecto
		const DEL_PROYECTO="DELETE FROM PROYECTO WHERE ID=?";

}
?>