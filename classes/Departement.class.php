<?php

class Departement
{

    private $dep_num;

    private $dep_nom;

    private $vil_num;

    public function __construct($valeurs = array())
    {
        if (! empty($valeurs)) {
            $this->affecte($valeurs);
        }
    }

    public function affecte($donnees = array())
    {
        foreach ($donnees as $attribut => $valeur) {
            switch ($attribut) {
                case 'dep_num':
                    $this->dep_num = $valeur;
                    break;
                case 'dep_nom':
                    $this->dep_nom = $valeur;
                    break;
                case 'vil_num':
                    $this->vil_num = $valeur;
                    break;
            }
        }
    }

    public function getNum()
    {
        return $this->dep_num;
    }

    public function getNom()
    {
        return $this->dep_nom;
    }

    public function getVilNum()
    {
        return $this->vil_num;
    }
}
?>
