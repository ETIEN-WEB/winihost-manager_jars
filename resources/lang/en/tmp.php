<?php

return [
    'sussess' => [
        'title' => 'Success',
        'default' => 'your operation was successful',
    ],
    'messages' => [
        'welcome' => [
            'title' => "Important information",
            'client' => "Dear Customer,",
            'text' => "It is with great pleasure that we inform you of the change of all your interfaces Winihost.com (website and manager [client area] ) Please do not hesitate to send us your comments using the contact form. Hoping that you will appreciate the fruit of our efforts for you, we wish you a good discovery of the site. The Winihost team thanks you for your trust."
        ],
        'coockies' => [
            'title' => "Cookie notice",
            'text' => 'We use cookies and similar technologies on this website, which helps us to know a little bit about you and how you use our website. This improves the browsing experience for you and enables us to tailor better products and services to you and others. Cookies are stored locally on your computer or mobile device. Simply click "Accept" to remove this message !'
        ],
    ],
    'error' => [
        'title' => 'Error',
        'default' => 'Oupss something wrong',
        'uploade_pp' => 'the photo must not exceed 2M',
    ],
    'loader' => [
        'msg' => 'operation in progress ...'
    ],
    
    'dashboard' => [],
    'bouton' => [
        'login' => "Connexion",
        'register' => "Create my account",
        'show' => "Show",
        'hide' => "Hide",
        'reset' => "Reset",
        'activer' => "Activate now",
    ],
    'ajax' => [
        'chargement' => 'Loading ...'
    ],
    'input' => [
        'placeholder' => [
            'last_name' => "Last name ...",
            'first_name' => "First name ...",
            'email' => "Email address ...",
            'password' => "Password ...",
            'password_new' => "New password ...",
            'password_confirmation' => "Confirm the password ...",
            'city' => "City ...",
            'code_sponsor' => "Sponsor code (optional) ...",
            'remember_me' => "Remember me",
            'cgu' => "I accept the terms and conditions ",
            'token_activation' => "Activation code ...",
        ],
    ],
    'flasher' => [
        'change_language' => "Language changed successfully",
        'need_login' => "Oops! Please login",
        'success_register' => "Congratulations! Your registration has been done successfully. An activation email has been sent to ",
        'success_activer' => "Congratulations, your account has been successfully activated",
        'logout_success' => "Successful disconnection",
        'success_send_password' => "A link to reset your password has been sent to you by email.",
        'success_reset_password' => "Your password has been correctly reset",

        '1001' => "Incorrect email or password",
        '1003' => "Mail already in use",
        '1004' => "No account is attached to this email",
        '2001' => "Invalid or missing X-Auth-Key",
        '2003' => "Invalid or missing token activation",
        '2004' => "Invalid or missing email",
        '2005' => "Invalid or missing password",
    ],
    'topbar' =>[
        'user-icon' => [
            'my_account' => 'My account',
            'suscribe' => 'Subscription',
            'points' => 'Points',
            'order' => 'Orders',
            'ticket' => 'Tickets',
            'notification' => 'Notifications',
            'logout' => 'Logout'
        ]
    ],
    'header' =>[
        'parainage' => 'Sponsorship',
        'filleul' => 'godchildren(s)',
        'ticket' => 'Ticket(s)',
        'point' => 'Point(s)',
        'share_modal_label' => 'Share my referral code',
        'cancerl_btn_label' => 'Cancel',
        'menu' => [
            'dashboard' => 'Dashboard',
            'suscribe' => 'Subscription',
            'points' => 'Points',
            'order' => 'Orders',
            'ticket' => 'Tickets',
            'notification' => 'Notifications',
        ],
        'breadcrumb' => [
            'services' => 'Our services',
            'ambassador' => 'How to get Money with',
        ]
    ],
    'home' => [
        'user_edit' => [
            'info' => [
                'tab_lib' => 'Info',
                'input_name_ph' => 'First name',
                'input_last_name_ph' => 'Last names',
                'input_city_ph' => 'City',
                'input_phone_ph' => 'Phone',
                'show_update_btn' => 'Update my profil',
                'show_update_psw_btn' => 'Update Password',
                'hide_update_btn' => 'Save',
            ],
            'security' => [
                'tab_lib' => 'Sécurity',
                'hold_pw_ph' => 'Current password',
                'new_pw_ph' => 'New password',
                'show_update_btn' => 'Edit password',
                'hide_update_btn' => 'Update',
                'errors' => [
                    '1005' => 'Old incorrect password',
                ]
            ],
            'session' => [
                'tab_lib' => 'Session',
                'show_history' => 'View session history',
                'hide_history' => 'Hide',
            ]
        ],
        'content' => [
            'baner' =>[
                'title' => 'WINIHOST AT YOUR LISTENING 24/7',
                'help' => 'Help'
            ],
            'list_items_block' => [
                'hosting' => 'Hosting',
                'domain' => 'Domain(s)',
                'opent_ticket' => 'Open Ticket (s)',
                'order' => 'Order(s)',
            ],
            'renew_block' =>[
                'block_label' => 'NUMBER OF SERVICES AND DOMAINE THAT WILL EXPIRE IN LESS THAN 5 DAYS OR HAVE EXPIRED',
                'domain' => 'Domain(s)',
                'hosting' => 'Hosting(s)',
                'btn' => 'Renew your services',
            ],
            'point' => [
                'block_label' => 'REMAINING CREDIT',
                'btn' => 'Buy credit',
            ],
            'ticket' => [
                'block_label' => 'TOTAL NUMBER OF TICKET',
                'waitting_ticket' => 'TICKETS PENDING',
                'answer_ticket' => 'TICKET CLOSED',
                'btn' => 'Issue a ticket',
            ],
            'site' => [
                'block_label' => 'MONITORING SITE',
                'anormal' => 'ABNORMAL OPERATION',
                'normmal' => 'NORMAL RUNNING',
                'btn' => 'ADD A SITE',
            ],
            'modal_add_ticket' => [
                'modal_label' => 'Ticket creation',
                'objet_label' => 'Object',
                'objet_ph' => 'Fill in the subject',
                'type_label' => 'Select type',
                'level_label' => 'Emergency level',
                'file_label' => 'Attached file',
                'msg_label' => 'Message',
                'cancel_btn' => 'Cancel',
                'save_btn' => 'Save',
            ],
            'modal_confirm' => [
                'label' => 'Do you want to delete?',
                'yes_btn' => 'YES',
                'no_btn' => 'NO'
            ],
            'facebook' => [
                'suivez_nous' => 'Folow us on Facebook'
            ]
        ]
    ],
    'suscribe' => [
        'title' => 'Subscription',
        'domaine' =>[
            'title' => 'Domain',
            'tab_label' => 'DOMAIN',
            'buy_btn' => 'Buy',
            'add_btn' => 'Add',
            'table' => [
                'user_name' => 'Name',
                'statut' => 'Status',
                'hebergement' => 'Hosting',
                'expiration' => 'Expiration',
                'action' => 'Action',
                'renew_btn' => 'Renew',
                'afficher_btn' => 'Show',
            ],
            'modal' => [
                'modal_label' => 'Adding a domain',
                'hebergement_label' => 'Hosting',
                'domaine_label' => 'Domain',
                'domaine_ph' => 'Ex: domain-name.com',
                'cancel_btn' => 'Cancel',
                'save_btn' => 'Save',
            ],
            'detail' => [
                'les_entree' => 'DNS entries',
                'bouton_ajout' => 'Add a DNS entry',
                'resume_card_titre' => 'Summary of your domain',
                'resume_card_date' => 'Date added',
                'resume_card_date_expire' => 'Expiry date',
                'resume_card_renouveller' => 'Renew',
                'dns_card_tittre' => 'DNS servers',
                'dns_1' => 'Primary DNS server (NS1)',
                'dns_2' => 'Secondary DNS server (NS2)',
                'delete_btn' => 'Delete',
                'clear_cache_btn' => 'Clear DNS cache',
                'tableau' => [
                    'nom' => 'Name',
                    'type' => 'Type',
                    'valeur' => 'Value',
                    'proprieté' => 'Priority',
                    'action' => 'Actions',
                ],
                'form' => [
                    'titre' => 'DNS ENTRY CREATION',
                    'type' => 'Types',
                    'name' => 'Name',
                    'name_ph' => 'Name of dns entry',
                    'contenu' => 'content',
                    'contenu_ph' => 'content of the dns entry',
                    'propriete' => 'Propoerty',
                    'propriete_ph' => 'Enter the priority',
                    'ssl_certificat' => 'SSL Certificate',
                ]
            ],
        ],
        'hebergement' => [
            'tab_label' => 'HOSTING',
            'add_btn' => 'Add hosting',
            'table' => [
                'user_name' => 'Name',
                'package' => 'Package',
                'serveur' => 'Server',
                'expiration' => 'Expiration',
                'creation' => 'Creation',
                'etat' => 'State',
                'action' => 'Action',
                'en_cours' => 'In progress',
                'terminer' => 'Finish',
                'illimite' => 'UNLIMITED',
                'show' => 'Show',
                'renew' => 'Renew',
            ]
        ]
    ],
    'point' => [
        'total_point' => 'Total point',
        'amount' => 'Amount',
        'convert_box' => [
            'tabs_label' => 'Conversion',
            'cv_from' => 'Convert from',
            'cv_to' => 'Convert to',
            'point' => 'Point',
            'montant' => 'Amount',
            'input_ph' => 'Value',
            'submit_btn' => 'Convert',
        ],
        'table' => [
            'action' => 'Action',
            'sens' => 'Smells of the operation',
            'date' => 'Date',
        ]
    ],
    'panier' => [
        'table' => [
            'operation' => 'operations',
            'service' => 'Service',
            'prix' => 'Price',
            'duree' => 'Duration',
            'qualite' => 'Quantity',
            'total' => 'Total',
            'action' => 'Action',
        ],
        'generate_box' => [
            'title' => 'Subtotal',
            'input_ph' => 'promo code',
            'verif_msg' => 'Verification in progress',
            'generate_btn' => 'Generate the payment slip',
            'invalide_code_msg' => 'invalid promo code'
        ],
        'condition_box' => [
            'titre' => 'PAYMENT CONDITIONS AND POLICIES',
            'description' => "Any payment voucher generated must be paid within 72 hours.
                              Payments are made by credit card or by mobile via Orange Money, MTN Money or Flooz.
                              If the payment voucher is not paid within the time limit, it will no longer be valid."
        ],
        'panier_vide' => [
            'titre' => 'your shopping cart is empty',
            'description' => 'To place orders, click',
            'bouton' => 'Order'
        ],
    ],
    'order' => [
        'title' => 'Order',
        'search_ph' => 'Search',
        'table' => [
            'ref' => 'Ref',
            'montant_ht' => 'Amount HT',
            'tva' => 'TVA',
            'date' => 'Date',
            'status' => 'Status',
            'btn_action' => 'Show',
            'btn_afficher' => 'Show',
            'btn_facture' => 'Bill'
        ],
        'enmpty' => [
            'message' => 'No command available',
            'instruction' => 'To place orders, by clicking',
            'btn' => 'Order'
        ],
        'detail_page' => [
            'title' => 'Order' ,
            'detail_tabs_title' => 'ORDER DETAIL',
            'montant_ht' => 'Amount HT',
            'code_promo' => 'Promo code',
            'tva' => 'TVA',
            'montant_ttc' => 'Amount incl',
            'facture' => 'Bill',
            'btn_submit' => 'Make the payment',
            'show_facture' => 'payment invoice',
            'panier_tabs_title' => 'Basket detail',
            'table_panier' => [
                'service' => 'Services',
                'Package' => 'Package',
                'action' => 'Action',
                'detail' => 'Detail'
            ]
        ]
    ],
    'ticket' => [
        'title' => 'Billet',
        'creer' => 'Create',
        'historique' => 'Historical',
        'label_card_title' => 'In order to better assist you, please select the category, then the sub-category that most closely matches your concern.',
        'table' => [
            'identifiant' => 'Identifiant',
            'objet' => 'Objet',
            'date' => 'Date',
            'type' => 'Type',
            'status' => 'Status',
            'action' => 'Action',
            'show_btn ' => 'Show',
            'en_cours' => 'In progress',
            'terminier' => 'Finish',
            'technique' => 'Technical',
            'commercial' => 'commercial',
            'autres' => 'Other',
        ],
        'faire_demande' => 'Make a request',
        'technique' => [
            'badge' => 'Technical',
            'text' => 'Any request concerning a technical problem. (Ex: A service does not work correctly, account management problem, bugs, etc.)'
        ],
        'commercial' => [
            'badge' => 'Commercial',
            'text' => 'Any request of a commercial nature. (Do you have questions regarding the creation, modification, renewal of a service?)'
        ],
        'autres' => [
            'badge' => 'Other requests',
            'text' => 'Any request that is neither technical nor commercial.'
        ],
        'modal_create' => [
            'title' => 'Ticket creation',
            'objet_label' => 'Object',
            'objet_ph' => 'Fill in the subject',
            'urgence_label' => 'Emergency level',
            'level_1' => 'Level 1',
            'level_2' => 'Level 2',
            'level_3' => 'Level 3',
            'fichier' => 'Attached file',
            'message' => 'Message',
            'annuler' => 'Cancel',
            'valider' => 'Submit'
        ]
    ],
    'domaine' => [
        'title' => 'Register your domain name',
        'sub_title' => 'Find your new domain name. Enter your name or keyword below to check availability.',
        'place_holder' => 'domain-name.com',
        'search_btn' => 'Search',
        'invalide' => 'is not valid',
        'available' => 'is available',
        'commander' => 'Order',
        'en_cours_de_recherche' => 'Verification in progress ...',
        'disponible' => 'Available',
        'indisponible' => 'Unavailable',
        'nim_string' => 'Please enter at least 3 characters',
    ],
    'notification' => [
        'selectionner_tous' => 'Select all',
        'table' => [
            'objet' => 'Object',
            'contenu' => 'Content',
            'recu_le' => 'Received at',
            'lu_le' => 'Read at',
            'action' => 'Actions',
        ],
        'confirmation' => [
            'msg' => [
                'titre' => 'Warning',
                'text' => 'You will delete this notification. Are you sure you want to continue?'
            ],
            'cancel' => 'Cancel',
            'confirm' => 'continue',
        ]
    ]
];
