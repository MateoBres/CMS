# Delivery Service

## Descrizione

il servizio deve permettere con facilita' la possibilita' per un utente di trovare i ristoranti/negozi/bar che fanno attivita' di consegne e prese ordini.
L'utente puo' inoltre mettersi in contatto con l'attivita', effettuare un ordine (articoli, indirizzo consegna, ora indicativa di consegna) e decidere se prenderlo in negozio oppure, se possibile scegliere per la consegna a casa.

## Inizializzazione progetto

-   Installare le dipendenze Composer
    > `composer install`
-   Installare i pacchetti npm
    > `npm i`
-   Generare le chiavi per l'applicazione
    > `php artisan key:generate`
-   Creare un database ed aggiungere i dati di connessione in .env
-   Copiare le variabili non-standard da .env.example in .env
-   Creare link a Storage
    > `php artisan storage:link`
-   Lanciare le migration
    > `php artisan migrate`
-   Inizializzare Laravel Passport
    > `php artisan passport:install`
    > `php artisan passport:keys`
-   Lanciare il seeder dei comuni italiani
    > `php artisan db:seed --class=ItalianDistrictSeeder`
- Lanciare seeder per Role e Type
    > `php artisan db:seed --class=RoleSeeder`
    > `php artisan db:seed --class=RetailerTypeSeeder`
    > `php artisan db:seed --class=CategorySeeder`
    > `php artisan db:seed --class=OrderStatusSeeder`
    > `composer dump-autoload`
-   Spostarsi nella directory del progetto e avviare il server
    > `php artisan serve`
-   Iniziare il watch di JS per attualizzare eventuali modifiche
    > `npm run watch`


## API

### Utenti

#### endpoints

> | Method | Endpoint          | Description              | Authorization | Controller     | Action  | Status |
> | ------ | ----------------- | ------------------------ | ------------- | -------------- | ------- | ------ |
> | GET    | /api/users        | return list of all users | administrator | UserController | index   | done   |
> | GET    | /api/users/{user} | return specified user    | std_user      | UserController | show    | done   |
> | POST   | /api/users/create | create a new user        | administrator | UserController | store   | done   |
> | PUT    | /api/users/{user} | edit user                | std_user      | UserController | update  | done   |
> | DELETE | /api/users/{user} | delete user              | std_user      | UserController | destroy | done   |

### Negozi

#### endpoints

> | Method | Endpoint            | Description                                                  | Controller         | Action       | Status |
> | ------ | ------------------- | ------------------------------------------------------------ | ------------------ | ------------ | ------ |
> | GET    | /api/retails        | lista di tutti i negozi                                      | RetailerController | index        | done   |
> | GET    | /api/retails/{zip}  | lista di tutti i negozi che sercvono in quel particolare cap | RetailerController | index_by_zip | done   |
> | POST   | /api/retails/create | crea un nuovo negozi e lo associa ad un utente(publisher)    | RetailerController | store        | done   |
> | GET    | /api/retails/{id}   | ottieni le informazion iriguardanti un nuovo negozio         | RetailerController | show         | done   |
> | PUT    | /api/retails/{id}   | modifica negozio                                             | RetailerController | update       | done   |
> | DELETE | /api/retails/{id}   | elimina negozio e tutti i dati ad esso associati             | RetailerController | destroy      | done   |

### Articoli

#### endpoints

> | Method | Endpoint                       | Description                                                | Authorization | Controller     | Action  | Status |
> | ------ | ------------------------------ | ---------------------------------------------------------- | ------------- | -------------- | ------- | ------ |
> | GET    | /api/retails/{id}/items        | mostra una lista di tutti gli articoli riferiti al negizio | //            | ItemController | index   | done   |
> | GET    | /api/retails/{id}/items/{id}   | mostra informazioni riguardanti l'articolo                 | //            | ItemController | show    | done   |
> | POST   | /api/retails/{id}/items/create | crea un nuovo articolo                                     | std_user      | ItemController | store   | done   |
> | DELETE | /api/retails/{id}/items/{id}   | elimina articolo e tutti i dati ad esso associati          | std_user      | ItemController | update  | done   |
> | UPDATE | /api/retails/{id}/items/{id}   | modifica articolo                                          | std_user      | ItemController | destroy | done   |

### Ingredienti

#### endpoints

> | Method | Endpoint                                        | Description                                                     |
> | ------ | ----------------------------------------------- | --------------------------------------------------------------- |
> | GET    | /api/retails/{id}/items/{id}/ingredients        | mostra una lista di tutti gli ingredienti riferiti all'articolo |
> | POST   | /api/retails/{id}/items/{id}/ingredients/create | crea un nuovo ingrediente                                       |
> | GET    | /api/retails/{id}/items/{id}/ingredients/{id}   | mostra informazioni riguardanti l'ingrediente                   |
> | DELETE | /api/retails/{id}/items/{id}/ingredients/{id}   | elimina ingrediente                                             |
> | UPDATE | /api/retails/{id}/items/{id}/ingredients/{id}   | modifica articolo                                               |

### Ordini (lato negoziante)

#### endpoints

> | Method | Endpoint                      | Description                                                 | Authorization | Controller | Action | Status |
> | ------ | ----------------------------- | ----------------------------------------------------------- | ------------- | ---------- | ------ | ------ |
> | GET    | /api/retails/{id}/orders      | mostra una lista di tutti gli ordini riferiti al negoziante | ------------- | ---------- | ------ | ------ |
> | GET    | /api/retails/{id}/orders/{id} | dettaglio ordine                                            | ------------- | ---------- | ------ | ------ |

### Ordini (lato utente)

#### endpoints

> | Method | Endpoint           | Description                              | Authorization | Controller      | Action  | Status |
> | ------ | ------------------ | ---------------------------------------- | ------------- | --------------- | ------- | ------ |
> | GET    | /api/orders        | lista di tutti gli ordini di un utente   | //            | OrderController | index   | done   |
> | GET    | /api/orders/{id}   | mostra informazioni riguradanti l'ordine | //            | OrderController | show    | done   |
> | POST   | /api/orders/create | crea un nuovo ordine                     | std_user      | OrderController | store   | done   |
> | DELETE | /api/orders/{id}   | elimina ingrediente                      | std_user      | OrderController | update  | done   |
> | UPDATE | /api/orders/{id}   | modifica articolo                        | std_user      | OrderController | destroy | done   |

### Indirizzi (lato utente)

#### endpoints

> | Method | Endpoint             | Description                               | Authorization | Controller        | Action  | Status |
> | ------ | -------------------- | ----------------------------------------- | ------------- | ----------------- | ------- | ------ |
> | GET    | /api/adresses        | lista di tutti gli indirizzi di un utente | //            | AddressController | index   | done   |
> | POST   | /api/adresses/create | crea un nuovo indirizzo                   | //            | AddressController | show    | done   |
> | GET    | /api/adresses/{id}   | mostra informazioni riguradanti indirizzo | std_user      | AddressController | store   | done   |
> | DELETE | /api/adresses/{id}   | elimina indirizzo                         | std_user      | AddressController | update  | done   |
> | UPDATE | /api/adresses/{id}   | modifica indirizzo                        | std_user      | AddressController | destroy | done   |

### Comuni

#### endpoints

> | Method | Endpoint                  | Description                                                                    | Controller                | Action         | Status |
> | ------ | ------------------------- | ------------------------------------------------------------------------------ | ------------------------- | -------------- | ------ |
> | GET    | /api/districts/{district} | ritorna una lista (limit 10) dei comuni in base ai caratteri del nome digitati | ItalianDistrictController | index_by_query | done   |
> | GET    | /api/zip/{zip}            | ritorna una lista (limit 10) dei comuni in base ai caratteri del cap digitati  | ItalianDistrictController | show_query     | done   |

## Strutture Dati

### Retailer->info

    {
        "description": "",
        "phone": "",
        "email": "",
        "zip_codes": [],
        "min_order":"",
        "social": {
            "facebook": "",
            "twitter": "",
            "instagram": ""
        },
        "im": {
            "whatsapp": "",
            "fb_messenger": "",
            "telegram": ""
        },
        "geo": {
            "lat": "",
            "lng": ""
        },
        "timeslots": [
            {
                "id": 1,
                "name": "Lunedì",
                "opening_schedule":"",
                "delivery_schedule":"",
                "takeaway_schedule":"",
                "delivery_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ],
                "takeaway_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ],
                "opening_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ]
            },
            ...
            {
                "id": 7,
                "name": "Domenica",
                "opening_schedule":"",
                "delivery_schedule":"",
                "takeaway_schedule":"",
                "delivery_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ],
                "takeaway_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ],
                "opening_hours": [
                    {
                        "start": "",
                        "end": ""
                    }
                ]
            }
        ]
    }



## PWA
### Workbox:
https://developers.google.com/web/tools/workbox

Set manifest,json in '/public' folder

Install workbox: 
`> npm install -g workbox-cli `

launch wizard from the root folder `> workbox wizard`
- select 'public' folder

generate service worker file: `> workbox generateSW`


### query to fix database:

```
UPDATE items
SET info = '{"weight":{"unit":"","value":"","price":""},"size":{"unit":"","value":"","price":""},"size_list":[],"color_list":[]}';
```

```
UPDATE items
SET variation = '{"color_list":[],"size_list":[],"composition":[]}';
```

### docker postgre
```
docker run --name dev-postgres \
    -e POSTGRES_USER=postgreuser \
    -e POSTGRES_PASSWORD=123456 \
    -e PGDATA=/var/lib/postgresql/data/pgdata \
    -p 5432:5432 \
    -d postgres
```


php artisan make:migration create_item_images_table --create=item_images

php artisan make:migration add_variation_to_items


