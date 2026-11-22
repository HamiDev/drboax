# Drbotax

Drbotax is an online shop for beauty and cosmetic products. WordPress and WooCommerce run locally with Docker. The storefront is a custom theme, `drbotax`.

## Requirements

Docker with Compose v2.

## Run locally

```bash
cp .env.example .env
docker compose up -d
```

- Shop: http://localhost:8080
- phpMyAdmin: http://localhost:8081

The first start writes WordPress into `wordpress/`. Core, plugins, uploads, and the database volume stay out of git. The theme at `wordpress/wp-content/themes/drbotax` is the tracked application code.

Stop the stack with `docker compose down`. Database data is kept in the `db_data` volume.

## Theme

| Item | Value |
| --- | --- |
| Path | `wordpress/wp-content/themes/drbotax` |
| Text domain | `drbotax` |
| Styles | SCSS, compiled with Dart Sass |
| Commerce | WooCommerce template overrides and hooks |
| Settings | Theme Customizer for color, type, buttons, header, footer, layout, spacing, logo, and social links |

Entry stylesheet: `scss/styles.scss`. Compile it to `assets/css/main.css` and commit that file. `style.css` holds the WordPress theme header. PHP enqueues the compiled stylesheet.

```bash
sass scss/styles.scss assets/css/main.css --watch --style=expanded
```

Run that command from the theme directory once `scss/styles.scss` exists.

Partials live under `scss/abstracts`, `base`, `layout`, `components`, `pages`, and `utilities`. Load them with `@use` and `@forward`. Motion (hover, entrance, drawers) is CSS, uses `transform` and `opacity`, and is disabled when the shopper prefers reduced motion.

### Primary menu and product category mega menu

1. **Appearance → Menus**: create a Header menu with Home, Shop, Blog (or other pages).
2. Add a **Custom Link** for Product Categories (title e.g. “دسته بندی محصولات”; URL = Shop page or `#`).
3. **Screen Options** → enable **CSS Classes**.
4. On that item, set the class `drbotax-mega`.
5. Assign the menu to the **Primary** location.

The theme injects a live WooCommerce `product_cat` mega panel into that item. You do not add every category to the menu by hand.

## Development rules

Project conventions for agents and contributors are in `.cursor/rules/`:

- `project.mdc` — product, stack, and what may be changed
- `wordpress-php.mdc` — sanitization, escaping, and WordPress APIs
- `templates.mdc` — template parts and semantic markup
- `scss.mdc` — Sass architecture and design tokens
- `motion.mdc` — transitions and animation

## Repository layout

```
.
├── .env.example            # environment template
├── docker-compose.yml      # WordPress, MySQL, phpMyAdmin
├── README.md
└── wordpress/
    └── wp-content/themes/drbotax/
```

`php.ini` and `apache-uploads.conf` raise upload limits for large site imports. They are not mounted by Compose.
