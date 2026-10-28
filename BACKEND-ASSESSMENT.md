# Back-end WordPress Assessment Guide

## Our website

This is a separate WordPress website for the back-end assessment. It does not use the front-end assessment's property cards or review slider.

- Website: https://splace-back.local.dev/
- Dashboard: https://splace-back.local.dev/wp-admin/
- Job list: https://splace-back.local.dev/jobs/
- Project folder: `/Users/markcaneda/Sites/splace/backend`
- Theme: **Splace Backend Assessment**

## Setup steps

1. Start the local web and database servers used for this website.
2. Open the WordPress dashboard and sign in.
3. Go to **Appearance > Themes** and activate **Splace Backend Assessment**.
4. Go to **Settings > Permalinks**, select **Post name**, and save. This lets job pages use readable addresses.
5. Open **Jobs > Add New Job**.
6. Enter the job title and description.
7. Under **Job Details**, enter the salary and location.
8. Click **Publish**.
9. Open `/jobs/` to see the published job.
10. Click the job title or **View job** to open its full page.

WordPress is already installed in this project. You do not need to install it again to use the existing site.

## What we built

### Jobs in the dashboard

We added a **Jobs** menu where an administrator can add, edit, and move job entries to Trash using WordPress's usual controls.

### Job information

Each job has:

- **Job Title:** uses the normal WordPress title box.
- **Description:** uses the main WordPress editor.
- **Salary:** an extra text box under Job Details.
- **Location:** another text box under Job Details.

Salary and location are saved with their job and loaded again when it is reopened for editing. Only someone allowed to edit the job can save these fields.

### Public job list

The `/jobs/` page shows published jobs. Each entry displays its title, salary, location, and a link to its full page. If there are many jobs, the list includes page navigation. If there are none, it shows a message.

### Individual job page

Each published job has its own page showing the title, salary, location, and description. An **All jobs** link returns to the list. Blank salary or location fields display **Not specified**.

### Basic appearance

We added a simple header, Jobs navigation link, footer, and styling that fits smaller screens. No extra plugins are needed for this Jobs functionality.

## Files we created

All seven theme files are in:

`wp-content/themes/splace-backend-assessment/`

| File | What it does |
| --- | --- |
| `style.css` | Gives WordPress the theme's name and controls the colors, spacing, and appearance of the pages. |
| `functions.php` | Adds Jobs to the dashboard, creates and saves Salary and Location, and loads the theme's styling. It also provides the shared display of job details. |
| `header.php` | Shows the website name and the Jobs navigation link at the top of each page. |
| `footer.php` | Shows the website name and copyright year at the bottom of each page. |
| `index.php` | Shows the homepage with a link to the Jobs list. It also provides a backup layout for other pages. |
| `archive-splace_job.php` | Shows the public list of published jobs. |
| `single-splace_job.php` | Shows the full page for one job. |

## How to edit a job

1. Go to **Jobs > All Jobs**.
2. Open the job you want to change.
3. Change its title, description, salary, or location.
4. Click **Save** or **Update**.
5. Refresh the public job list and individual job page to see the changes.

## How to remove a job from the list

1. Go to **Jobs > All Jobs**.
2. Move the job to **Trash**.
3. Refresh `/jobs/`. The job should no longer appear.
4. To bring it back, open **Trash** and restore it.

## What we checked

- The **WordPress Developer** entry was saved as a published Job.
- Its salary and location were saved successfully.
- The public job list opened and displayed the saved information.
- The individual job page opened and displayed the details and description.
- The theme's PHP files passed syntax checks.

The adding, editing, and Trash steps were provided for you to try. Their full results have not been independently checked. Git upload and reviewer access have not been completed in this walkthrough.
