<?php class Fase{

	protected $proyecto;
	protected $id;
	protected $title;
	protected $descripcion;
	protected $fechaLimit;

	public function __construct($atributos){
		foreach ($atributos as $key => $value) {
			if(property_exists(__CLASS__, $key)){
				$this->$key=$value;
			}
		}
	}

	public function __set($atributo,$valor){
		if(property_exists(__CLASS__, $atributo)){
			$this->$atributo=$valor;
		}
	}
	public function __get($atributo){
		if(property_exists(__CLASS__, $atributo)){
			return $this->$atributo;
		}
		return NULL;
	}
	
}
?>