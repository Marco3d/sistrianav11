<?php 
require_once 'principal.php';
class Subactas extends Principal {

private $registros;
private $categoria;


public function __construct() {
        $this->registros = array();
        $this->registros_docentes = array();
        $this->categoria = array();

        
    }
//*************traer todos las categorias*************************************************************

 public function getcategoria(){
			parent::Conectar();
			$consulta = sprintf(
							"select idcategoria, nombre_categoria from categoria;"
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->categoria[] = $reg;
			}
			
			return $this->categoria;
		}

//*************traer todos los registros*************************************************************
    public function get() {
        parent::Conectar();
        $consulta = sprintf(
                "select id_archivos, iddocentes, idcategoria,  descripcion, anio, jornada, sede, fecha,  archivo FROM archivos order by id_archivos asc;"
        );
        $result = mysql_query($consulta);

        while ($reg = mysql_fetch_assoc($result)) {
            $this->registros[] = $reg;
        }

        return $this->registros;
    }

//*************traer todos los registros subidos relacionadolo con otra tabla*************************************************************
public function get_docentes() {
        parent::Conectar();
        $consulta = sprintf(
                "select      p.id_archivos, p.iddocentes, p.descripcion, p.anio, 
                			 p.jornada, p.sede, p.fecha, p.archivo,  
                             d.iddocentes,d.nombre_docentes,
                             c.idcategoria,c.nombre_categoria
							 FROM
							 archivos as p,
							 docentes as d,
							 categoria as c
							 where
							 p.iddocentes=d.iddocentes
							 and p.idcategoria=c.idcategoria
							 order by id_archivos desc;"
        );
        $result = mysql_query($consulta);
        if ($result) {

            while ($reg = mysql_fetch_assoc($result)) {
                $this->registros_docentes[] = $reg;
            }
        }

        return $this->registros_docentes;
    }


//**********************AGREGAR DATOS*******************************************************

			public function add(){
			parent::Conectar();

			
				$max_file_size = 500000; //500 kb
				$valid_formats = array("xlsx", "xls" ,"doc", "docx", "pdf", "jpg", "png", "txt", "ppt", "pptx");
      
	        	 move_uploaded_file($_FILES['archivo']['tmp_name'],"../actas/misactas/".$_FILES["archivo"]["name"]);
			     $nom=$_FILES["archivo"]["name"];
	     
	        		

			// //verificar que no este repetido el archivo
			 $consulta = "SELECT archivo FROM archivos WHERE archivo = '$nom'";
			 			
			 				
			 			
			 $result = mysql_query($consulta);
			
			//echo mysql_num_rows($result);exit;
			
			 if (mysql_num_rows($result) == 0) {

			 	 if ($_FILES['archivo']['size'] > $max_file_size) {
	             	header("Location: ../actas.php?mensaje=6");
	             	continue;

	        	   } if (empty($_POST['idcategoria'])) {
 					 header("Location: ../actas.php?mensaje=8");
 					  continue;

 					} if ($_POST['idcategoria']!=5) {
 					 header("Location: ../actas.php?mensaje=9");
 					 continue;
								
		        	  } if( ! in_array(pathinfo($nom, PATHINFO_EXTENSION), $valid_formats) ){
		       		  header("Location: ../actas.php?mensaje=7");
		       		  continue;
				
	        	 } else{
				//inserta archivo en la base de datos
				$consulta = sprintf(
								"INSERT INTO archivos values(null, %s, %s, %s, %s, %s, %s, now(),'$nom')",
								parent::comillas_inteligentes($_POST["iddocentes"]),
								parent::comillas_inteligentes($_POST["idcategoria"]),
								parent::comillas_inteligentes($_POST["descripcion"]),
								parent::comillas_inteligentes($_POST["anio"]),
								parent::comillas_inteligentes($_POST["jornada"]),
								parent::comillas_inteligentes($_POST["sede"])
								
							);
				$result = mysql_query($consulta);

				//echo mysql_query($consulta);exit;

				header("Location: ../actas.php?mensaje=5");}

			 } else {
			 	header("Location: ../actas.php?mensaje=4");
			 }
			
		}		
 
//*************traer registros por ID*************************************************************

 	public function getId($id){
			parent::Conectar();
			$consulta = sprintf(
							"select id_archivos, iddocentes, idcategoria, descripcion, anio, jornada, sede, fecha,  archivo from archivos where id_archivos=%s;",
							parent::comillas_inteligentes($id)
						);
			$result = mysql_query($consulta);
			
			while ($reg = mysql_fetch_assoc($result)) {
				$this->registros[] = $reg;
			}
			
			return $this->registros;
		}

//*************actualizar registros por ID*************************************************************
public function update($id){
			parent::Conectar();
			
					
				$consulta = sprintf(
								"UPDATE archivos SET iddocentes=%s, idcategoria=%s,  descripcion=%s, anio=%s, jornada=%s, sede=%s ,fecha=%s, archivo=%s WHERE id_archivos=%s;",
								parent::comillas_inteligentes($_POST["iddocentes"]),
								parent::comillas_inteligentes($_POST["idcategoria"]),
								parent::comillas_inteligentes($_POST["descripcion"]),
								parent::comillas_inteligentes($_POST["anio"]),
								parent::comillas_inteligentes($_POST["jornada"]),
								parent::comillas_inteligentes($_POST["sede"]),
								parent::comillas_inteligentes($_POST["fecha"]),
								parent::comillas_inteligentes($_POST["archivo"]),
								

								parent::comillas_inteligentes($_POST["id"])
							);
				$result = mysql_query($consulta);
				header("Location: ../actas.php?mensaje=1");

				
			
			
		}

//*************borrar archivo*************************************************************


				public function delete($id){
							parent::Conectar();
							
							
								$consulta = sprintf(
											"delete from archivos where id_archivos = %s",
											parent::comillas_inteligentes($id)
										);
								mysql_query($consulta);
								header("Location: ../actas.php?mensaje=2");
							
						}	
			
			
} //*************FIN DE LA CLASE*************************************************************




 ?>