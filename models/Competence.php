
<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Connect.php";

Class Competence
{
    //Implementamos nuestro constructor
    public function __construct()
    {

    }  // este es el modelo de competence que sera el area donde tu trabajaras, si te fijas son puras consultas con la base  que hace conexion
    //con la base de datos// despues este modelo se utiliza en la carpeta que se llama ajax, donde se utiliza opciones para las url

    //Implementamos un método para insertar registros
    public function insert($title,$code, $typee, $description,$parent_id)
    {
        //echo($title.$code.$typee.$description.$parent_id);
        //$this->DeleteCodSaved($code);
        $sql="INSERT INTO categories (title, code, typee, description, parent_id)
        VALUES ('$title','$code','$typee','$description','$parent_id')";
        // echo($sql);
        return ejecutarConsulta($sql);
    }
    public function insertPadre($title,$code, $typee,$parent_id)
    {
        $sql="INSERT INTO categories (title,code,typee,parent_id)
        VALUES ('$title','$code','$typee','$parent_id')";
        return ejecutarConsulta($sql);
    }

    public function insertfather(){

        $sql="SELECT title, idcategorie FROM categories WHERE parent_id = 0";
        return ejecutarConsulta($sql);
    }
    public function combotype(){

        $sql="SELECT type_valor, IdTypeCategories FROM type_ctegories";
        return ejecutarConsulta($sql);
    }



    public function getcodeChildren($idcategorie){

        $sql="SELECT SUM(1) as numerohijos FROM categories WHERE parent_id=".$idcategorie."";
        return ejecutarConsulta($sql);
    }

    public function getcodeFather($idcategorie){

        $sql="SELECT code  FROM categories WHERE idcategorie=".$idcategorie."";
        return ejecutarConsulta($sql);

    }

    public function getCodesDeletedCategories($idcategorie){

        $sql="SELECT CodeDeleted  FROM categories_deleted_codes WHERE IdFatherCategorie=".$idcategorie."";

        return ejecutarConsulta($sql);

    }



    //Implementamos un método para editar registros
    public function edit($idcategorie,$title,$code,$typee, $description,$parent_id)
    {
        $sql="UPDATE categories SET title='$title',code='$code',typee='$typee',description='$description', parent_id='$parent_id' WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    public  function salveCodigoDeleted($parent_id,$code){
        $sql="INSERT INTO categories_deleted_codes (CodeDeleted,IdFatherCategorie)
        VALUES ('$code','$parent_id')";
        return ejecutarConsulta($sql);
    }
    public function DeleteCat($idcategorie)
    {
        $sql="DELETE FROM categories  WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    public function DeleteCodSaved($cod)
    {
        $sql="DELETE FROM categories_deleted_codes  WHERE CodeDeleted='$cod'";
        return ejecutarConsulta($sql);
    }
    public function DeleteCodSavedbyFther($IdFatherCategorie)
    {
        $sql="DELETE FROM categories_deleted_codes  WHERE IdFatherCategorie ='$IdFatherCategorie'";
        return ejecutarConsulta($sql);
    }

    public function DeleteHijosofFther($IdFatherCategorie)
    {
        $sql="DELETE FROM categories  WHERE parent_id ='$IdFatherCategorie'";
        return ejecutarConsulta($sql);
    }


    //Implementamos un método para desactivar categorías
    public function deactivate($idcategorie)
    {
        $sql="UPDATE categories SET condicion='0' WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    //Implementamos un método para activar categorías
    public function activate($idcategorie)
    {
        $sql="UPDATE categories SET condicion='1' WHERE idcategorie='$idcategorie'";
        return ejecutarConsulta($sql);
    }

    //Implementar un método para mostrar los datos de un registro a modificar
    public function show($idcategorie)
    {
        $sql="SELECT * FROM categories WHERE idcategorie='$idcategorie'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //Implementar un método para listar los registros
    public function tolist()
    {

        $sql="SELECT * FROM categories";
        return ejecutarConsulta($sql);
    }

    public function treeview(){
        $sql="SELECT * FROM categories LEFT JOIN type_ctegories ON typee = IdTypeCategories";//"SELECT * FROM categories";//"SELECT * FROM categories WHERE idcategorie = 2 or parent_id = 2 or idcategorie = 3 or parent_id = 3";
        return ejecutarConsulta($sql);

    }

    public function get_node(){
        $sql="SELECT * FROM categories";
        return ejecutarConsulta($sql);

    }
}

?>