<?php

class Usuario4 {

    private $idusuarios;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getIdusuarios() {
        return $this->idusuarios;
    }
    public function setIdusuarios($value) {
        $this->idusuarios = $value;
    }

    public function getDeslogin() {
        return $this->deslogin;
    }
    public function setDeslogin($value) {
        $this->deslogin = $value;
    }

    public function getDessenha() {
        return $this->dessenha;
    }
    public function setDessenha($value) {
        $this->dessenha = $value;
    }

    public function getDtcadastro() {
        return $this->dtcadastro;
    }
    public function setDtcadastro($value) {
        $this->dtcadastro = $value;
    }

    public function loadById($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuarios = :ID", array (
            ":ID"=>$id
        ));

        //if (isset($results[0]) {
        if (count ($results) > 0) {

            $this->setData($results[0]);
        }
    } 
//adicionado para o exemplo2
    public static function getList(){

        $sql = new Sql();
        
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
        
        ':SEARCH'=>"%" . $login . "%"
        ));
    }

    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array (
            ":LOGIN"=>$login,
            ":PASSWORD"=>$password
        ));

        //if (isset($results[0]) {
        if (count ($results) > 0) {

            $this->setData($results[0]);

        } else {

            throw new Exception("Login e/ou senha inválidos.");
        }

    }
//
//adicionado para o exemplo3 insert

    public function setData($data){

        $this->setIdusuarios($data['idusuarios']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
        
    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)",array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha()
        ));

        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }

//adicionado para o ex4 update

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuarios = :ID", array(
            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuarios()
        ));
    }

    public function __construct ($login = "", $password = ""){

        $this->setDeslogin($login);
        $this->setDessenha($password);

    }
//
    public function __toString(){
        
        return json_encode(array(
            "idusuarios"=>$this->getIdusuarios(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));

    }
}





?>