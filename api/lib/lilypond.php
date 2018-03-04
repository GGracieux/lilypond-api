<?php 

class LilyPond {

    // dossier temporaire pour le traitement lilypond
    const TMP_DIR = '/tmp/lilypond';

    // Id de session unique
    private $id;

    // Dossier de travail pour la session
    private $dir;

    // Chemin complet du fichier d'entrée
    private $inputFile;

    // Chemin complet du fichier de log
    private $logFile;


    //-----------------------------------------
    // CONVERTION
    //-----------------------------------------

    public function convert($lpData) {

        try {

            // Initialisation
            $this->initPath();
            mkdir($this->dir,0777, true);
            file_put_contents($this->inputFile,$lpData);

            // Execution Lilypond
            $cmd  = "lilypond -o $this->dir $this->inputFile > $this->logFile 2>&1";
            exec($cmd,$op,$retVal);
            if ($retVal!=0) throw new Exception("Erreur lors de l'execution lilypond");

            // Compose le retour OK
            $result = $this->getConvertResponse(true,'');

        } catch (Exception $ex) {

            // Compose le retour ERREUR
            $result = $this->getConvertResponse(false, $ex->getMessage());
        }

        return $result;
    }

    /**
     * Initialise les chemins
     */
    private function initPath() {
        $this->id = uniqid();
        $this->dir = self::TMP_DIR . '/' . $this->id;
        $this->inputFile = $this->dir . '/' . $this->id . ".lp";
        $this->logFile = $this->dir . '/' . $this->id . ".log";
    }

    /**
     * Prepare la réponse du Convert
     * @param $success
     * @param $message
     * @return array
     */
    private function getConvertResponse($success, $message) {
        return array(
            'status' => array(
                'code' => $success ? 'OK' : 'ERROR',
                'message' => $message
            ),
            'base64PdfData' => $this->getResultFile('pdf'),
            'base64MidiData' => $this->getResultFile('midi'),
            'logs' => $this->getLogData()
        );
    }

    /**
     * Charge les données d'un fichier résultat
     * @param $ext
     * @return string
     */
    private function getResultFile($ext) {
        $result = '';
        $file = "$this->dir/$this->id.$ext";
        if (is_file($file)) {
            $result = base64_encode(file_get_contents($file));
        }
        return $result;
    }

    /**
     * Charge les données du fichier de log
     * @return array
     */
    private function getLogData() {
        $log = array();
        if (is_file($this->logFile)) {
            $log[] = array(
                'title' => 'Lilypond : Generation PDF et Midi',
                'content' => file_get_contents($this->logFile)
            );
        }
        return $log;
    }

}