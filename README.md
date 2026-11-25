# Abdoun CMS

Dockerized CMS running on PHP 5.6, Apache 2, and MySQL 5.7.

## Run

```bash
docker-compose up -d --build
```

Open: http://localhost:8080

## Services

- `web`: PHP 5.6 + Apache, document root `public_html`
- `db`: MySQL 5.7, database `framework`

MySQL is exposed on host port `3307` (`root` / `root`).

## Database

On first run, `admin_init_conf/framework.sql` is imported automatically into the `framework` database with UTF-8.

## Notes

- PHP short open tags are enabled.
- `mcrypt` extension is enabled.
- Application config files use the `db` host and password `root`.