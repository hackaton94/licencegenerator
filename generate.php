<?php
class LicenseGenerator {
    private $chars_numbers = '0123456789';
    private $chars_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    private $chars_special = '!@#$%&*';
    
    public function generateLicense($include_special = true) {
        $characters = $this->chars_numbers . $this->chars_letters;
        
        if ($include_special) {
            $characters .= $this->chars_special;
        }
        
        $license = 'BTE-';
        
        // Générer 4 segments de 4 caractères
        for ($i = 0; $i < 4; $i++) {
            $segment = '';
            for ($j = 0; $j < 4; $j++) {
                $segment .= $characters[random_int(0, strlen($characters) - 1)];
            }
            $license .= $segment;
            if ($i < 3) {
                $license .= '-';
            }
        }
        
        return $license;
    }
    
    public function generateMultipleLicenses($quantity, $include_special = true) {
        $licenses = [];
        
        for ($i = 0; $i < $quantity; $i++) {
            $licenses[] = $this->generateLicense($include_special);
        }
        
        return $licenses;
    }
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    $include_special = isset($_POST['include_special']);
    
    // Limiter la quantité pour des raisons de sécurité
    $quantity = max(1, min(50, $quantity));
    
    $generator = new LicenseGenerator();
    $licenses = $generator->generateMultipleLicenses($quantity, $include_special);
    
    // Rediriger vers la page principale avec les résultats
    $encoded_licenses = base64_encode(serialize($licenses));
    header('Location: index.php?licenses=' . urlencode($encoded_licenses));
    exit;
} else {
    // Redirection si accès direct
    header('Location: index.php');
    exit;
}
?>