# Thème WordPress — Women in AI Cameroon (WAI-CAM)

Thème WordPress officiel converti depuis la maquette HTML/CSS validée par la cliente.

**Version :** 3.0.10 — version indépendante du thème WAI-CAM v2, adaptée à Local by Flywheel + CPT UI + ACF + Fluent Forms
**WordPress requis :** 6.0+
**Testé jusqu'à :** 6.9.4
**PHP requis :** 8.0+

---

## ⚠️ Prérequis (avant d'activer le thème)

Ces extensions doivent être **déjà installées et actives** dans WordPress :

| Plugin | Rôle |
|--------|------|
| **Custom Post Type UI** | Fournit les CPT (déjà déclarés via l'interface) |
| **Advanced Custom Fields** | Fournit les champs personnalisés des CPT |
| **Fluent Forms** | Fournit les formulaires (contact, adhésion, partenariat) |
| **WooCommerce** | E-commerce (boutique, dons, produits) |
| **MemberPress** | Espace membre, adhésions et contenus réservés |
| **LearnPress** | Optionnel : affichage d’une page individuelle de cours si des cours LearnPress existent |

Le thème **NE redéclare PAS** les CPT — il les utilise. Si tu désactives CPT UI, les contenus seront invisibles (mais pas perdus).

### CPT requis (slugs exacts)

| CPT | Slug | Source |
|---|---|---|
| Témoignage | `temoignage` | CPT UI |
| Partenaire | `partenaire` | CPT UI |
| Programme | `programme` | CPT UI |
| Évènement | `evenement` | CPT UI |

### Champs ACF requis

**Témoignage** (groupe « Informations du Témoignage »)
- `nom_complet` (texte) · `role__fonction` (texte, **double underscore !**) · `profil_professionnel` (texte) · `citation` (zone de texte) · `photo` (image)

**Partenaire** (groupe « Informations du Partenaire »)
- `nom_du_partenaire` (texte) · `type_de_partenariat` (liste) · `logo` (image) · `description_du_partenariat` (zone de texte) · `site_web` (URL) · `date_du_partenariat` (date)

**Programme** (groupe « Informations du Programmes »)
- `nom_programme` (texte) · `accroche_courte` (zone de texte) · `description_complete` (WYSIWYG) · `activites` (zone de texte, séparé par virgules) · `public_cible` (texte) · `image_dillustration` (image, **slug spécial**)

**Évènement** (groupe « Informations de l'Évènement »)
- `nom_evenement` (texte) · `type_evenement` (liste) · `statut` (liste) · `date_de_evenement` (date) · `heure_de_debut` (texte) · `lieu` (texte) · `description` (WYSIWYG) · `image_mise_en_avant` (image) · `nombre_de_participantes` (nombre)

---

## 📦 Installation du thème

### 1. Compresser le dossier en .zip

Avant l'upload, copiez/renommez le dossier du thème en `waicam-v3/`, puis compressez ce dossier en `waicam-v3.zip`. Cette étape permet à WordPress d'installer cette version à côté du thème WAI-CAM v2 sans remplacer le dossier existant `waicam/`.

### 2. Uploader dans WordPress

1. WP-Admin → **Apparence → Thèmes**
2. Bouton **Ajouter** → **Téléverser un thème**
3. Sélectionner `waicam-v3.zip` → **Installer maintenant**
4. Cliquer **Activer**

## 🔁 Mettre à jour le thème sans perdre la configuration

Pour une correction ou une nouvelle page, gardez toujours le même dossier de thème `waicam-v3/` et incrémentez la version du thème (`style.css` + `WAICAM_VERSION` dans `functions.php`). Ne créez pas un dossier `waicam-v3-new/`, sinon WordPress considérera qu'il s'agit d'un autre thème.

Procédure recommandée :

1. Préparer le nouveau zip en gardant le dossier racine `waicam-v3/`.
2. WP-Admin → **Apparence → Thèmes → Ajouter → Téléverser un thème**.
3. Envoyer le zip et choisir **Remplacer le thème actuel par la version téléversée**.
4. Purger les caches : plugin de cache, cache hébergeur/CDN et cache navigateur.
5. Vérifier que `assets/css/wp-extras.css?ver=...` utilise bien le nouveau numéro de version.

Le contenu WordPress (pages, médias, produits WooCommerce, galeries, CPT UI/ACF) reste en base de données. Les routines de mise à jour du thème ajoutent les nouvelles pages sans remplacer les pages existantes.

### 3. Lancer l'installation automatique

Au premier accès à l'admin après activation, une notice te proposera de **lancer l'installation**. Sinon :

1. Aller dans **Outils → WAI-CAM Setup**
2. Cliquer le bouton **🚀 Lancer l'installation**

Cela crée automatiquement :
- Les 8 pages du site (Accueil, À propos, Programmes, Équipe, Témoignages, Partenaires, Contact, Rejoindre)
- Le menu principal avec les bons templates assignés
- La page d'accueil statique

### 4. Configurer les permaliens

**Réglages → Permaliens** → choisir **Nom de l'article** → Enregistrer.
Cette étape est obligatoire pour que les CPT et leurs archives fonctionnent.

### 5. Connecter les formulaires Fluent Forms

1. **Apparence → Personnaliser → WAI-CAM → Formulaires Fluent Forms**
2. Pour chaque formulaire, saisir l'**ID** (visible dans Fluent Forms → Tous les formulaires, première colonne)
   - Formulaire de contact → ID 5
   - Formulaire d'adhésion → ID 3
   - Formulaire partenariat → ID 4
   - Formulaire inscription programme → (à créer)
   - Formulaire newsletter → (à créer ou laisser ID 2 si "Subscription Form" est utilisé)

### 6. Configurer MemberPress / Espace membre

Le thème ajoute une page **Espace membre** (`/espace-membre/`) avec le template `WAI-CAM — Espace membre`. Cette page sert d’habillage visuel WAI-CAM autour des formulaires MemberPress.

1. Installer et activer **MemberPress**.
2. Aller dans **MemberPress → Settings / Options → Pages**.
3. Assigner la page **Espace membre** comme page **Account**.
4. Créer les niveaux d’adhésion dans **MemberPress → Memberships**.
5. Protéger les contenus réservés via **MemberPress → Rules**.

Le thème crée aussi automatiquement la page `espace-membre` lors d’une mise à jour si elle n’existe pas, puis l’ajoute au menu principal sans dupliquer les entrées existantes.

### 7. Configurer les coordonnées et réseaux sociaux

**Apparence → Personnaliser → WAI-CAM → Coordonnées** + **Réseaux sociaux**

---

## 🏗️ Structure du thème

```
waicam/
├── style.css                    # En-tête WP obligatoire
├── functions.php                # Setup, scripts/styles, menus, walker, customizer
├── header.php / footer.php      # En-tête + footer communs
├── front-page.php               # Page d'accueil dynamique
├── page.php / index.php / 404.php
├── archive-evenement.php        # Liste des évènements (avec filtre par statut)
├── single-evenement.php         # Page détail d'un évènement
├── inc/
│   ├── cpt.php                  # Volontairement vide (CPT gérés par CPT UI)
│   ├── helpers.php              # waicam_field(), waicam_image_url(), etc.
│   └── setup-wizard.php         # Auto-installation pages + menu
├── template-parts/
│   └── page-hero.php            # Hero réutilisable (breadcrumb + titre)
├── page-templates/
│   ├── template-about.php
│   ├── template-programmes.php
│   ├── template-equipe.php      # Utilise CPT temoignage
│   ├── template-temoignages.php # Utilise CPT temoignage (avec citation)
│   ├── template-partenaires.php
│   ├── template-contact.php
│   └── template-rejoindre.php
└── assets/
    ├── css/main.css + wp-extras.css
    ├── js/main.js
    └── images/
```

---

## 🐛 Dépannage

### Les CPT ou pages n'apparaissent pas
→ Vérifier que **CPT UI** est actif et que les CPT existent (Outils → CPT UI → Modifier les types)
→ **Réglages → Permaliens** → cliquer Enregistrer

### Les contenus ACF s'affichent vides
→ Vérifier que **Advanced Custom Fields** est actif
→ Vérifier que les noms de champs ACF correspondent exactement à ceux listés ci-dessus
→ Spécialement : `role__fonction` (double underscore) et `image_dillustration` (sans apostrophe)

### Les formulaires affichent un message "à connecter"
→ Aller dans **Apparence → Personnaliser → WAI-CAM → Formulaires Fluent Forms** et saisir les ID

### Logo non affiché dans le header
→ **Apparence → Personnaliser → Identité du site → Logo**

---

## 📞 Support

Développé par **ENIX SARL** — `contact@enix.cm`
Pour Women in AI Cameroon — `womeninaicameroon@gmail.com`
