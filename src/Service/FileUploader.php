<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    //on crée une propriété qui va stocker le chemin vers le dossier d'upload
    private $targetDirectory;

    public function __construct($directory)
    {
        //lors de l'instanciation on remplit la propriété avec le chemin vers le dossier d'upload
        $this->targetDirectory = $directory;

    }

    public function upload(UploadedFile $file, $oldFileName = null)
    {
        //nom de fichier aléatoire
        $fileName =  md5(uniqid()) . '.' . $file->guessExtension();

        //transfert du fichier
        $file->move($this->targetDirectory, $fileName);

        //supprimer l'eventuelle ancienne image
        //si on m'a fourni un nom de fichier et que ce nom existe bien
        if($oldFileName and file_exists($this->targetDirectory . '/' . $oldFileName)){
            //je supprime le fichier
            unlink($this->targetDirectory . '/' . $oldFileName);
        }

        return $fileName;
    }
}