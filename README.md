# 📊 EVSAKIP — Government Performance Accountability Evaluation System

> A comprehensive web-based platform for evaluating organizational performance accountability across multiple government work units.

## 🎯 Project Summary
EVSAKIP is a centralized evaluation system built for the Inspectorate to assess the Government Agency Performance Accountability System (SAKIP). It streamlines the entire evaluation lifecycle—from unit-level self-assessments to inspectorate evaluations and final cross-unit recapitulations.

- **Status:** Active / Completed
- **Tech Stack:** CodeIgniter 3, PHP, MySQL, JavaScript
- **UI Framework:** AdminLTE, HTML/CSS
- **Domain:** e-Government / Performance Management

## ✨ Key Features
*   **Self-Assessment (PM):** Allows individual work units to input performance scores and attach supporting evidence documents.
*   **Inspectorate Evaluation (EV):** Independent assessment module for evaluators to review, score, and provide feedback on work unit implementations.
*   **Cross-Unit Recapitulation:** Aggregated comparison dashboard generating automated predicate grading (AA to E).
*   **Recommendation Tracking:** End-to-end tracking of inspectorate recommendations and unit-level follow-up actions.
*   **Real-time Collaboration:** In-app notification system featuring threaded comments per performance indicator.
*   **Data Export & Reporting:** Automated Excel (.xlsx) report generation for assessments, evaluations, and recapitulation data.

## 🔐 Role-Based Access Control (RBAC)
The system implements a granular, 6-tier permission architecture to maintain data integrity and strict workflow hierarchies:
1.  **Admin:** Full system configuration, user management, and data resets.
2.  **Supervisor:** (Team Lead / Technical Controller) Oversees evaluations across all units with access to historical change logs.
3.  **Evaluation Team:** Assesses assigned work units and inputs official scores.
4.  **Work Unit (User):** Manages self-assessments, uploads evidence, and responds to follow-up recommendations.

## 🏗️ Architecture Overview (MVC)
The application follows a strict Model-View-Controller pattern using CodeIgniter 3:
*   `Controllers/`: Handles business logic and routing (Auth, Dashboard, PM, EV, Rekomendasi).
*   `Models/`: Centralized data access layer for complex relational queries.
*   `Views/`: Server-rendered pages utilizing the AdminLTE template for a responsive dashboard experience.
*   `Core/`: Extended `MY_Controller` serving as a centralized authentication guard and role constant manager.
