<?php require_once('Proyecto.php'); ?>
<?php class ProyectoExtended extends Proyecto{
	
	protected $creador; //USER_PROYECTO(id_user, id_status=0)
	protected $collabs;
	protected $fechaCreacion;
	protected $status; //on, hiatus, finished, cancelled, ...

} ?>