<?php

namespace Object;

class Factory
{
	public $fileContent;
	public $table;
	public $separator;
	public $fileName;
	public $file;

	private $mainDir;
	private $tab;
	private $finalReq;

	/**
	 *
	 * @param string $fileContent
	 * @param string $table
	 * @param string $separator
	 * @param string $fileName
	 * @param object $file
	 *
	 */
	public function __construct($fileContent='', $table='', $separator='', $fileName='', $file=null)
	{
		$this->fileContent 	= $fileContent;
		$this->table 		= $table;
		$this->separator 	= $separator;
		$this->fileName 	= $fileName;
		$this->file 		= $file;

		$this->mainDir		= dirname(__DIR__);


		// create sql from imported file
		if ($this->fileName != '') {
			$this->getContentFromFile();
		}

	}

    /**
     * @return mixed
     */
    public function getFileContent()
    {
        return $this->fileContent;
    }

    /**
     * @param mixed $fileContent
     *
     * @return self
     */
    public function setFileContent($fileContent)
    {
        $this->fileContent = $fileContent;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param mixed $table
     *
     * @return self
     */
    public function setTable($table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * @param mixed $separator
     *
     * @return self
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     *
     * @return self
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     *
     * @return self
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Check if csv file is imported or there is something to transform to sql
     */
	public function checkValues() {
	    $error = '';

	    if (!$this->separator) {
	        $error .= "- Choisir un séparateur <br/>";
	    }

	    if (trim($this->fileContent) == '') {
	        $error .= "- Importer un fichier ou copiez le contenu dans la zone de texte";
	    }

	    if ($error != '') {
	    	$msg = "Veuillez: <br/>";
	    	$msg .= $error;
	        header("location:../index.php?erreur=$msg");
	        exit;
	    }

	}

	/**
	 *	create an array tab with these keys:
	 *		'column' 	: column name
	 *		'content' 	: datas
	 */
	public function createTab() {
		$tmpTab = explode("\n", $this->fileContent);

		$this->tab['column'] 	= array_shift($tmpTab);
		$this->tab['content'] 	= $tmpTab;
	}

	/**
	 *	create the insert into query
	 */
	public function generateSqlInsert() {
		$column = explode($this->separator, $this->tab['column']);
		$column = implode(',', $column);
		$column = trim($column);

		$req = "INSERT INTO $this->table ($column) VALUES \n";

		$valueTab = [];
		foreach ($this->tab['content'] as $key => $value) {
			$tmpTab = explode($this->separator, $value);
			$tmpTab = $this->escapeValue($tmpTab);

			$reqValue = implode(',', $tmpTab);

			$valueTab[] = "($reqValue)";
		}

		$reqValue = implode(', ', $valueTab);

		$req .= "$reqValue;";

		$this->finalReq = $req;
	}

	/**
	 *	add `...` to sql values
	 */
	private function escapeValue($tmpTab) {
		$returnTab = [];

		foreach ($tmpTab as $key => $value) {
			$returnTab[] = "`".trim($value)."`";
		}

		return $returnTab;
	}

	/**
	 * create a file with the insert sql
	 */
	public function generateSqlFile() {
		$fileName = $this->mainDir.'/tmp/'.$this->table.'.sql';

		fopen($fileName, "w");
		file_put_contents($fileName, $this->finalReq);

		return $this->table.'.sql';
	}

	public function getContentFromFile() {
		$this->fileContent = trim(file_get_contents($this->fileName));
	}

}