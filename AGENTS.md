# Lendable Aggregate

`lendable/aggregate` is a PHP library providing supporting functionality to bridge domain and infrastructure interactions for aggregates within event sourcing systems. It does not help build out your domain; instead it provides interfaces and base functionality for an infrastructure layer to interact with aggregate classes without requiring them to implement library-specific interfaces. The core contracts are `AggregateIdExtractor`, `AggregateTypeResolver`, and `AggregateVersionExtractor`, with matching `*Spec` base classes under `Lendable\Aggregate\Testing` to ease testing of implementations.

- **Type:** Composer library (`lendable/aggregate`), distributed via Packagist.
- **Requirements:** PHP >= 8.3.
- **Source layout:** production code in `src/` (PSR-4 `Lendable\Aggregate\`); tests in `tests/` (`tests/unit/`, `tests/fixture/`, `tests/helper/`).

## Build, test, and lint commands

All checks run through Composer scripts (defined in `composer.json`). Run them inside the project's containerised dev environment or against a local PHP 8.3 + Composer install.

- `composer ci` — full CI suite (audit, static analysis, unit tests, code style check).
- `composer static-analysis` — `composer validate` + `composer normalize --dry-run` + license check + lint + PHPStan + Deptrac + Rector dry-run.
- `composer tests:unit` (alias `composer phpunit:unit`) — run the unit test suite.
- `composer phpstan` — PHPStan analysis of `src/`, `tests/`, and `rector.php`.
- `composer deptrac` — architecture/dependency boundary checks.
- `composer code-style:check` / `composer code-style:fix` — PHP-CS-Fixer (dry-run / apply).
- `composer rector:check` / `composer rector:fix` — Rector (dry-run / apply).
- `composer lint` — parallel PHP lint of `src/` and `tests/`.
- `composer licenses:check` — Composer license checker.
- `composer security:check` — `composer audit --no-dev`.

## Local development environment

A Docker Compose environment is provided via the `Makefile`:

- `make up` — build and start the containers.
- `make shell` — open a shell in the `runner` container (run Composer scripts from here).
- `make down` — stop and remove the containers.

## Conventions

- **Commits:** Conventional Commits (enforced by `commitlint`; releases are automated via release-please). Renovate is configured to use semantic commit messages.
- **Ownership:** see `.github/CODEOWNERS`.
- **New code:** production code goes under `src/` (PSR-4 `Lendable\Aggregate\`); tests mirror it under `tests/unit/`.

## Consuming shared agent assets

Shared agent assets (skills, agents, commands, hooks, MCP servers) live under `.agents/` and are managed by the Lendable agents CLI ([`@lendable/ai-agents-cli`](https://jfrog.shared.prod.zable.co.uk/artifactory/api/npm/npm/@lendable/ai-agents-cli)). Per-harness directories (`.claude/`, `.codex/`, `.cursor/`) contain only CLI-managed symlinks and sidecar config — never edit them by hand.

Install a shared `@lendable/ai-agent-*` package:

```bash
npm exec --yes --package=@lendable/ai-agents-cli@latest -- agents add <package-name>
```

Verify the working tree matches `.agents/lendable-manifest.json` (this is what CI runs):

```bash
npm exec --yes --package=@lendable/ai-agents-cli@latest -- agents check
```

Validate skill frontmatter and get recommendations:

```bash
npm exec --yes --package=@lendable/ai-agents-cli@latest -- agents lint --source=all
```

If you hit HTTP 401/403 fetching from the registry, this machine isn't authenticated to Lendable's Artifactory yet. Open the Getting Started guide and copy the Bootstrap prompt from there: https://automatic-sniffle-qjwj75e.pages.github.io/packages/ai-agents-cli/getting-started/
