#!/bin/bash

# Variables
KEY_FILE="./default.key"
CSR_FILE="./default.csr"
CRT_FILE="./default.crt"

# Générer une clé privée RSA de 2048 bits et la stocker dans un fichier
# chmod 644 rend la clé privée lisible pour tous les utilisateurs (utile pour des déploiements où les permissions sont importantes)
openssl genrsa -out "$KEY_FILE" 2048
chmod 644 "$KEY_FILE"

# Créer une demande de signature de certificat (CSR)
# Le paramètre -subj spécifie les détails du certificat : CN (Common Name), O (Organization), C (Country)
# Note : Utilisation de double slashes (//) et de backslashes (\) pour contourner le comportement spécifique de MinGW/MSYS
openssl req -new -key "$KEY_FILE" -out "$CSR_FILE" -subj "//CN=default\O=default\C=BE"

# Générer un certificat auto-signé valable 365 jours à partir de la CSR et de la clé privée
openssl x509 -req -days 365 -in "$CSR_FILE" -signkey "$KEY_FILE" -out "$CRT_FILE"

# Vérification de la création des fichiers
# Affiche un message de succès ou d'erreur selon que les fichiers ont été générés correctement ou non
if [ -f "$KEY_FILE" ] && [ -f "$CSR_FILE" ] && [ -f "$CRT_FILE" ]; then
    echo "Certificats générés avec succès."
else
    echo "Erreur lors de la génération des certificats."
fi
