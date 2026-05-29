# EVSAKIP — Government Performance Accountability Evaluation System

A web-based platform for evaluating organizational performance accountability (SAKIP) across multiple work units. Features self-assessment, inspectorate evaluation, cross-unit recapitulation, recommendations tracking, and Excel reporting — all with role-based access control.
---

## Features

- Self-Assessment (PM) — Work units fill in their own performance scores with supporting evidence
- Inspectorate Evaluation (EV) — Evaluators independently assess each work unit's SAKIP implementation
- Cross-Unit Recapitulation — Aggregated comparison view of all units with predicate grading (AA to E)
- Recommendation & Follow-Up — Track inspectorate recommendations and unit-level follow-up actions
- Document Management — Upload, manage, and track assessment documents per work unit
- In-App Notifications — Real-time notification system with threaded comments per indicator
- Excel Export — Export self-assessment, evaluation, and recapitulation data to formatted `.xlsx` files
- Dashboard Analytics — Visual overview of assessment progress, scores, and completion status
- Multi-Year Support — Switch between assessment periods without losing historical data
- 6-Tier Role System — Granular permissions from Admin to Unit Staff
---

## Roles

Admin — User management, data reset, full system configuration
Supervisor — (Team Lead, Technical Controller, Quality Controller) | View & edit evaluations across all units, view change history 
Evaluation Team — Assess assigned work units, score indicators
Work Unit — Self-assessment input, document upload, follow-up responses
---

## Project Structure

```
application/
├── controllers/      # Auth, Dashboard, PM, EV, Dokumen, Rekomendasi, TL, Users
├── models/           # Data access layer (PM, EV, Dashboard, Dokumen, etc.)
├── views/            # Server-rendered pages with AdminLTE layout
├── core/             # MY_Controller — centralized auth guard & role constants
├── config/           # Routes, database, autoload configuration
├── libraries/        # Custom libraries
├── helpers/          # Custom helper functions
└── templates/        # Shared layout (header, sidebar, footer)
