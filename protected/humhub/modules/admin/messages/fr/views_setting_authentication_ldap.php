<?php
/**
 * Message translations.
 *
 * This file is automatically generated by 'yii message' command.
 * It contains the localizable messages extracted from source code.
 * You may modify this file by translating the extracted messages.
 *
 * Each array element represents the translation (value) of a message (key).
 * If the value is empty, the message is considered as not translated.
 * Messages that no longer need translation will have their translations
 * enclosed between a pair of '@@' marks.
 *
 * Message string can be used with plural forms format. Check i18n section
 * of the guide for details.
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */
return [
    'Defines the filter to apply, when login is attempted. %uid replaces the username in the login action. Example: &quot;(sAMAccountName=%s)&quot; or &quot;(uid=%s)&quot;' => '',
    'LDAP Attribute for E-Mail Address. Default: &quotmail&quot;' => '',
    'Limit access to users meeting this criteria. Example: &quot(objectClass=posixAccount)&quot; or &quot;(&(objectClass=person)(memberOf=CN=Workers,CN=Users,DC=myDomain,DC=com))&quot;' => '',
    'The default credentials username. Some servers require that this be in DN form. This must be given in DN form if the LDAP server requires a DN to bind and binding should be possible with simple usernames.' => '',
    '<strong>Authentication</strong> - LDAP' => '<strong>Authentication</strong> - LDAP',
    'A TLS/SSL is strongly favored in production environments to prevent passwords from be transmitted in clear text.' => 'L\'utilisation du protocole TLS/SSL est fortement recommandé dans les environnements de production pour prévenir de la transmission des mots de passe en clair.',
    'Basic' => 'Basique',
    'LDAP' => 'LDAP',
    'LDAP Attribute for Username. Example: &quotuid&quot; or &quot;sAMAccountName&quot;' => 'Attribut LDAP pour Nom d\'utilisateur. Exemple: &quotuid&quot; ou &quot;sAMAccountName&quot;',
    'Save' => 'Enregistrer',
    'Status: Error! (Message: {message})' => 'Status : Erreur! (Message: {message})',
    'Status: OK! ({userCount} Users)' => 'Status : OK! ({userCount} Utilisateurs)',
    'The default base DN used for searching for accounts.' => 'La base par défaut DN utilisé pour la recherche de comptes.',
    'The default credentials password (used only with username above).' => 'Le mot de passe des informations d\'identification par défaut (utilisé uniquement avec identifiant ci-dessus).',
];
