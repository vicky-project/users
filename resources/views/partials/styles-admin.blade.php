<style>
  body {
    background-color: #f4f6f9;
  }
  .wrapper {
    display: flex;
    min-height: 100vh;
  }
  .sidebar {
    width: 250px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    transition: all 0.3s;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    }
    .sidebar.collapsed {
    width: 70px;
    }
    .sidebar .nav-link {
    color: rgba(255,255,255,0.8);
    padding: 0.8rem 1rem;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: all 0.2s;
    }
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
    background: rgba(255,255,255,0.1);
    color: white;
    }
    .sidebar .nav-link i {
    font-size: 1.2rem;
    min-width: 30px;
    text-align: center;
    }
    .sidebar.collapsed .nav-link span {
    display: none;
    }
    .content {
    flex: 1;
    margin-left: 250px;
    transition: margin-left 0.3s;
    padding: 20px;
    }
    .content.expanded {
    margin-left: 70px;
    }
    .navbar-top {
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    padding: 10px 20px;
    margin-bottom: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    }
    .toggle-sidebar {
    cursor: pointer;
    font-size: 1.5rem;
    color: #667eea;
    }
    .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card-header {
    background: white;
    border-bottom: 1px solid #e9ecef;
    font-weight: 600;
    }
    .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    }
    .btn-primary:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    }
    /* Responsive */
    @media (max-width: 768px) {
    .sidebar {
    margin-left: -250px;
    }
    .sidebar.active {
    margin-left: 0;
    }
    .content {
    margin-left: 0;
    }
    }
    /* Telegram Mini App adaptation */
    body.telegram-app .sidebar {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    }
    body.telegram-app .sidebar .nav-link {
    color: var(--tg-theme-text-color, #000000);
    }
    body.telegram-app .sidebar .nav-link:hover {
    background: var(--tg-theme-hint-color, #f0f0f0);
    }
    body.telegram-app .navbar-top {
    background: var(--tg-theme-secondary-bg-color, #f5f5f5);
    }
    </style>