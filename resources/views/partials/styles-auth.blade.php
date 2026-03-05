<style>
  body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    }
    .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 15px 15px 0 0 !important;
    padding: 1.5rem;
    font-weight: 600;
    font-size: 1.5rem;
    text-align: center;
    }
    .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    }
    body.telegram-app {
    background: var(--tg-theme-bg-color, #ffffff);
    }
    body.telegram-app .card {
    background: var(--tg-theme-bg-color, #ffffff);
    color: var(--tg-theme-text-color, #000000);
    box-shadow: none;
    }
    body.telegram-app .card-header {
    background: var(--tg-theme-button-color, #40a7e3);
    color: var(--tg-theme-button-text-color, #ffffff);
    }
    body.telegram-app .btn-primary {
    background: var(--tg-theme-button-color, #40a7e3);
    color: var(--tg-theme-button-text-color, #ffffff);
    }
    </style>