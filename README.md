# Task Manager App - Step-by-Step Progress & Scaffolding

This README documents the setup, scaffolding, and progress of the Task Manager full-stack application (Symfony API Platform backend, Vite + React + Tailwind frontend).

---

## 1. Backend Setup (Symfony)

- **Initialized Symfony project** with API Platform, Doctrine, JWT Auth, Mercure, MakerBundle.
- **Configured PostgreSQL** connection in `.env`.
- **Ran migrations** to set up the database schema.

### Entities & Relationships
- **User**: Registered with email and password (JWT auth).
- **Workspace**: ManyToMany with User, OneToMany with Board.
- **Board**: ManyToOne with Workspace.

### Auth
- **/api/register**: Custom registration endpoint for new users.
- **/api/login_check**: JWT login endpoint (LexikJWTAuthenticationBundle).

### Common Commands
```
php bin/console make:entity
php bin/console make:migration
php bin/console doctrine:migrations:migrate
php bin/console cache:clear
symfony serve
```

---

## 2. Frontend Setup (Vite + React + Tailwind)

- **Scaffolded with Vite**: `npm create vite@latest . -- --template react`
- **Installed Tailwind CSS**: `npm install -D tailwindcss postcss autoprefixer && npx tailwindcss init -p`
- **Configured Tailwind** in `tailwind.config.js` and `src/index.css`.
- **Installed React Router**: `npm install react-router-dom`
- **Set up Vite proxy** to backend: `/api` → `http://localhost:8000`

---

## 3. Frontend Pages & Features

- **HomePage**: Welcome, navigation
- **BoardsPage**: Example boards
- **BoardDetailPage**: Kanban columns/cards
- **LoginPage**: Integrated with `/api/login_check`, stores JWT
- **RegisterPage**: Integrated with `/api/register`
- **404 NotFound**: Friendly fallback
- **Navigation Bar**: All major routes

---

## 4. Auth Integration

- **Register**: POST `/api/register` (email, password)
- **Login**: POST `/api/login_check` (username, password), stores JWT in localStorage
- **Proxy**: Vite dev server proxies `/api` to backend

---

## 5. Troubleshooting & Known Issues
- Ensure backend is running from `backend` dir (`symfony serve`)
- If `/api/login_check` 404: check routing config in `config/routes/lexik_jwt_authentication.yaml` (should use `resource: "@LexikJWTAuthenticationBundle/config/routes.yaml"`)
- Restart both frontend and backend after config changes

---

## 6. Next Steps
- Scaffold protected routes and logout
- Connect boards/cards to backend
- Add real-time (Mercure) features
- Polish UI/UX with Tailwind

---

## 7. References
- [Symfony Docs](https://symfony.com/doc/current/index.html)
- [API Platform Docs](https://api-platform.com/docs/)
- [LexikJWTAuthenticationBundle](https://github.com/lexik/LexikJWTAuthenticationBundle)
- [Vite](https://vitejs.dev/)
- [Tailwind CSS](https://tailwindcss.com/)
- [React Router](https://reactrouter.com/)
