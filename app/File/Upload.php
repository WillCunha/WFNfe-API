<?php

namespace App\File;

class Upload{

    /**
     * Nome do arquivo
     */
    public $name;

    /**
     * Tipo do arquivo
     * @var string;
     */
    private $type;

    /**
     * Extensão do arquivo
     * @var string
     */
    private $extension;

    /**
     * Diretório temporário do arquivo
     * @var string
     */
    private $tmpName;

    /**
     * Código de erro
     * @var integer
     */
    private $error;

    /**
     * Tamanho do arquivo
     * @var integer
     */
    private $size;

    /**
     * Contador de duplicação do arquivo
     * @var integer
     */
    private $duplicates = 0;

    /**
     * Construtor da classe
     * @param array $file $_FILES[campo]
     */
    public function __construct($file){
        //Pega os dados do arquivo
        $this->type = $file['type'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
        $this->size = $file['size'];

        //Pega o nome do arquivo e a extensão, ambos separadamente
        $info = pathinfo($file['name']);
        $this->extension = $info['extension'];
    }


    /**
     * Metodo que faz o upload do arquivo
     * @param string $dir
     * @return boolean
     */
    public function upload($dir){
        $path = $dir.'/'.$this->name;

        $arquivo = fopen('teste.json', 'w');
        fwrite($arquivo, $path);
        fclose($arquivo);

        //Movimenta o arquivo para a pasta
        return move_uploaded_file($this->tmpName, $path);

    }

}

?>