# SAFA SHOP - Art de la Table

## À Propos
SAFA SHOP est une boutique en ligne spécialisée dans l'art de la table, proposant une sélection raffinée de vaisselle, verrerie et couverts pour sublimer votre table.

## Structure Détaillée des Fichiers

### Configuration
- `.env` : Configuration de l'environnement
  ```env
  APP_NAME="SAFA SHOP"
  DB_DATABASE=safa_shop
  # Configuration de la base de données et autres variables d'environnement
  ```

### Base de Données

#### Migrations
- `database/migrations/2024_01_08_000001_create_products_table.php`
  ```php
  // Structure de la table des produits
  public function up() {
      Schema::create('products', function (Blueprint $table) {
          $table->id();
          $table->string('name');
          $table->string('subtitle');
          $table->text('description');
          $table->decimal('price', 8, 2);
          $table->string('image');
          $table->integer('stock');
          $table->timestamps();
      });
  }
  ```

#### Seeders
- `database/seeders/ProductSeeder.php`
  ```php
  // Données initiales des produits
  public function run() {
      DB::table('products')->insert([
          [
              'name' => 'Wine Glass',
              'subtitle' => 'Set of 2 | Clear',
              // Autres détails des produits...
          ],
          // Autres produits...
      ]);
  }
  ```

### Vues (resources/views)

#### Layout Principal
- `resources/views/layouts/app.blade.php`
  ```blade
  <!DOCTYPE html>
  <html>
  <head>
      <!-- Meta tags, CSS, etc. -->
  </head>
  <body>
      <!-- Header avec navigation -->
      <nav>...</nav>
      
      <!-- Contenu principal -->
      @yield('content')
      
      <!-- Footer -->
      <footer>...</footer>
  </body>
  </html>
  ```

#### Pages Principales
- `resources/views/products/index.blade.php`
  ```blade
  @extends('layouts.app')
  @section('content')
      <!-- Liste des produits -->
      <div class="container">
          <!-- Système de sélection des produits -->
          <!-- Panier d'achat -->
      </div>
  @endsection
  ```

- `resources/views/welcome.blade.php`
  ```blade
  @extends('layouts.app')
  @section('content')
      <!-- Page d'accueil -->
  @endsection
  ```

### Routes
- `routes/web.php`
  ```php
  // Définition des routes de l'application
  Route::get('/', 'HomeController@index');
  Route::resource('products', 'ProductController');
  Route::resource('orders', 'OrderController');
  ```

### Contrôleurs
- `app/Http/Controllers/ProductController.php`
  ```php
  class ProductController extends Controller {
      // Affichage des produits
      public function index() {
          $products = Product::all();
          return view('products.index', compact('products'));
      }
      // Autres méthodes...
  }
  ```

- `app/Http/Controllers/OrderController.php`
  ```php
  class OrderController extends Controller {
      // Gestion des commandes
      public function store(Request $request) {
          // Validation et enregistrement des commandes
      }
  }
  ```

### Modèles
- `app/Models/Product.php`
  ```php
  class Product extends Model {
      protected $fillable = [
          'name', 'subtitle', 'description',
          'price', 'image', 'stock'
      ];
  }
  ```

### Assets
- `public/css/custom.css`
  ```css
  /* Styles personnalisés */
  .product-card {
      /* Styles des cartes produits */
  }
  .cart-panel {
      /* Styles du panier */
  }
  ```

### JavaScript
- `resources/js/cart.js`
  ```javascript
  // Gestion du panier
  const cart = {
      items: [],
      addItem(id, name, price, quantity) {
          // Logique d'ajout au panier
      },
      // Autres méthodes...
  };
  ```

## Fonctionnalités Principales

### Système de Panier
Le panier utilise JavaScript pour:
- Gestion dynamique des produits
- Calcul automatique des totaux
- Mise à jour en temps réel
- Persistance des données

### Gestion des Commandes
Le processus de commande comprend:
1. Validation des données
2. Enregistrement en base de données
3. Envoi de confirmation
4. Mise à jour des stocks

### Sécurité
Mesures de sécurité implémentées:
- Protection CSRF
- Validation des entrées
- Sanitization des données
- Gestion des sessions

## Fonctionnalités

### Pour les Clients
- Parcourir une collection élégante de produits pour la table
- Sélection facile des produits avec système de cases à cocher
- Bouton "Tout sélectionner" pour une commande rapide
- Panier d'achat dynamique avec calcul automatique des prix
- Réduction de 10% appliquée automatiquement
- Formulaire de commande simple et intuitif

### Caractéristiques Techniques
- Interface responsive et moderne
- Mise à jour en temps réel du panier
- Gestion dynamique des quantités
- Validation des formulaires côté client et serveur
- Design épuré et élégant

## Technologies Utilisées
- Laravel 10.x
- PHP 8.x
- MySQL
- Bootstrap 5
- JavaScript (Vanilla)
- HTML5/CSS3

## Installation

1. Cloner le projet
```bash
git clone [url-du-projet]
```

2. Installer les dépendances
```bash
composer install
npm install
```

3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de données dans le fichier .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=safa_shop
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe
```

5. Migrer et peupler la base de données
```bash
php artisan migrate
php artisan db:seed
```

6. Lancer le serveur
```bash
php artisan serve
```

## Structure du Projet

### Base de Données
- `products` : Gestion des produits (nom, description, prix, stock)
- `orders` : Suivi des commandes clients
- `order_items` : Détails des produits commandés

### Routes Principales
- `/` : Page d'accueil
- `/products` : Catalogue des produits
- `/orders` : Gestion des commandes

### Composants Principaux
- Layout principal avec header et footer
- Catalogue de produits avec système de filtrage
- Panier d'achat dynamique
- Formulaire de commande

## Maintenance

### Mise à jour des Produits
Pour ajouter ou modifier des produits, utilisez le seeder :
```bash
php artisan db:seed --class=ProductSeeder
```

### Sauvegarde
Sauvegarde régulière de la base de données recommandée :
```bash
php artisan backup:run
```

## Sécurité
- Protection CSRF sur tous les formulaires
- Validation des données entrantes
- Sécurisation des routes sensibles

## Support
Pour toute question ou assistance :
- Email : support@safashop.com
- Téléphone : +XX XX XX XX XX

## Licence
Tous droits réservés 2024 SAFA SHOP
