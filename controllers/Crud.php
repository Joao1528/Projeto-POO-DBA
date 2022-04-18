<?php
    require_once 'controllers./Conexao.php';
    class Crud extends Conexao{
        private $tabela;
        private $dados;
        private $conexao;
        private $sql;

      
        public function login($tabela, array $dados){
            $this->conexao =$this->conectar();
            $this->dados=$dados;
            $where='';
            foreach($this->dados as $coluna => $valor){
                $where .= "$coluna='$valor' and ";
            }
            $where=rtrim($where,'and ');
            $where=" WHERE ".$where;
             $this->sql="SELECT*FROM $tabela $where";
            $exe=$this->conexao->query($this->sql);
            //$sql_query = $mysqli ->query($sql_code) 
            return $exe;

        }
                
    }
?>