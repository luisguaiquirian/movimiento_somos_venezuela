<?

	if(!isset($_SESSION))
	{
		session_start();
	}	

	include_once $_SESSION['base_url'].'/class/system.php';
	$system = new System;


	$arreglo = [
					'usuario' => 'e_sucre',
					'password'=> password_hash('123456789',PASSWORD_DEFAULT),
					'perfil'  => 1,
					'activo'  => true,
					'password_activo' => false
				];

	$system->table = "users";
	$system->guardar($arreglo);

	$system->sql = "SELECT id_municipio, municipio from municipios where id_estado = 17";

	foreach ($system->sql() as $row) 
	{

		$row->municipio = str_replace(' ', '_', trim($row->municipio));

		$arreglo = [
					'usuario' => strtolower('M_'.$row->municipio),
					'password'=> password_hash('123456789',PASSWORD_DEFAULT),
					'perfil'  => 2,
					'municipio' => $row->id_municipio,
					'activo'  => true,
					'password_activo' => false
				];

		$system->table = "users";
		$system->guardar($arreglo);
	}

	$system->sql = "SELECT id_municipio, id_parroquia, parroquia from parroquias where id_estado = 17";

	foreach ($system->sql() as $row) 
	{
		$row->parroquia = str_replace(' ', '_', trim($row->parroquia));

		$arreglo = [
					'usuario' => strtolower('P_'.$row->parroquia),
					'password'=> password_hash('123456789',PASSWORD_DEFAULT),
					'perfil'  => 3,
					'municipio' => $row->id_municipio,
					'parroquia' => $row->id_parroquia,
					'activo'  => true,
					'password_activo' => false
				];

		$system->table = "users";
		$system->guardar($arreglo);
	}
	

?>