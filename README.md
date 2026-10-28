# Splace Back-end WordPress Assessment

A standalone local WordPress project for managing and displaying job openings. This project is separate from the front-end assessment.

## What is included

- A custom theme named **Splace Backend Assessment**.
- A **Jobs** section in the dashboard.
- Job title, description, salary, and location.
- A public list of published jobs.
- A full page for each job.
- Simple page styling, header, footer, and navigation.
- Job management using WordPress's built-in add, edit, and Trash controls.

No additional plugins are required for the Jobs functionality.

## Setup and use

1. Start the local servers for this WordPress site.
2. Sign in to `/wp-admin/`.
3. Activate **Splace Backend Assessment** under **Appearance > Themes**.
4. Save **Settings > Permalinks > Post name**.
5. Open **Jobs > Add New Job**, fill in the information, and publish.
6. Visit `/jobs/` and click a job to see its full page.

This project already contains WordPress. When using the theme on another WordPress installation, copy the `splace-backend-assessment` folder into that installation's `wp-content/themes/` folder and follow Steps 2–6. Job entries are stored in the site's database; copying the theme alone does not copy the entries.

## Theme files

```text
wp-content/themes/splace-backend-assessment/
├── style.css
├── functions.php
├── header.php
├── footer.php
├── index.php
├── archive-splace_job.php
└── single-splace_job.php
```

| File | Purpose |
| --- | --- |
| `style.css` | Theme name and page appearance. |
| `functions.php` | Jobs menu, salary/location fields, saving details, and shared theme features. |
| `header.php` | Website name and Jobs navigation. |
| `footer.php` | Bottom of the page and copyright. |
| `index.php` | Homepage and backup page layout. |
| `archive-splace_job.php` | List of published jobs. |
| `single-splace_job.php` | Details and description for one job. |

## Other folders in this WordPress project

| Folder or file | Purpose |
| --- | --- |
| `wp-admin/` | WordPress dashboard files. |
| `wp-includes/` | WordPress's built-in supporting files. |
| `wp-content/` | Themes, plugins, and uploaded files. Our assessment code is in its themes folder. |
| `wp-config.php` | This installation's database connection and site settings. |
| `BACKEND-ASSESSMENT.md` | Plain-language setup, walkthrough, and explanation of what we built. |
| `readme.html` | The standard information file supplied with WordPress. |

## Checks completed

The saved example job, salary, and location were checked. Both the public Jobs list and individual job page were opened successfully. All theme PHP files passed syntax checks.

The full add/edit/Trash walkthrough still needs its results confirmed. Git upload and reviewer access have not been completed in this walkthrough.

For the step-by-step explanation, read [the back-end assessment guide](BACKEND-ASSESSMENT.md).
