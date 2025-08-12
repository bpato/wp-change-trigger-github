# wp-change-trigger-github

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![GitHub release](https://img.shields.io/github/release/bpato/wp-change-trigger-github.svg)](https://GitHub.com/bpato/wp-change-trigger-github/releases/)
[![Github all releases](https://img.shields.io/github/downloads/bpato/wp-change-trigger-github/total.svg)](https://GitHub.com/bpato/wp-change-trigger-github/releases/)

A WordPress plugin that fires GitHub Actions automatically when content is created or updated, and can also be triggered manually from the WordPress admin panel.


## Features

- Automatically triggers a GitHub Actions workflow when posts or pages are created or updated.
- Manual trigger available from the WordPress admin panel.
- Uses Bearer token authentication for GitHub REST API calls.
- Prevents multiple consecutive executions using WordPress transients.
- Basic logging for easier debugging.

## Installation

1. Download or clone this repository.
2. Copy the `wp-change-trigger-github` folder into your WordPress site's `wp-content/plugins/` directory.
3. Run `composer install` inside the plugin directory to install dependencies (if required).
4. Activate the plugin from the WordPress admin panel.

## Configuration

After activation, go to **Tools > Wp Change Trigger Github** in the WordPress admin panel and fill in:

- **Repository Owner**: GitHub username or organization.
- **Repository Name**: Name of your GitHub repository.
- **Repository Workflow Name**: Filename of the workflow (e.g., `main.yml`).
- **Personal Access Token (Classic)**: A GitHub token with permissions to trigger workflows.

## Usage

- The plugin will automatically trigger the configured GitHub Actions workflow when you publish or update posts/pages.
- You can also trigger the workflow manually from the admin panel.

## Requirements

- WordPress 6.7 or higher
- PHP 7.4 or higher
- A GitHub repository with a workflow file

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for details.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

