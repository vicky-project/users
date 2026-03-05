<style>
  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    }

    body.telegram-app {
    background: #f8f9fa; /* latar putih bersih untuk Telegram */
    }

    .card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
    background-color: rgba(255, 255, 255, 0.9);
    }

    body.telegram-app .card {
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    backdrop-filter: none;
    }

    .card-header {
    background: transparent;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    text-align: center;
    font-size: 1.75rem;
    font-weight: 600;
    padding: 1.5rem 1.5rem 0.5rem;
    color: #333;
    }

    .card-body {
    padding: 1.5rem 2rem 2rem;
    }

    .form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.25rem;
    }

    .input-group-text {
    background-color: transparent;
    border-right: none;
    color: #6c757d;
    }

    .form-control {
    border-left: none;
    padding-left: 0;
    }

    .form-control:focus {
    box-shadow: none;
    border-color: #86b7fe;
    }

    .btn-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 2rem;
    padding: 0.6rem 1.5rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-link {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    }

    .btn-link:hover {
    color: #764ba2;
    text-decoration: underline;
    }

    .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
    }

    .invalid-feedback {
    font-size: 0.8rem;
    }

    .alert-danger {
    background-color: #fff2f0;
    border-color: #ffccc7;
    color: #a8071a;
    }

    .alert-dismissible .btn-close {
    filter: invert(0.2);
    }

    /* Ikon di dalam input */
    .input-icon {
    position: relative;
    }

    .input-icon i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #adb5bd;
    pointer-events: none;
    }

    .input-icon .form-control {
    padding-left: 2.8rem;
    border-left: 1px solid #ced4da;
    border-radius: 0.375rem;
    }

    .input-icon .form-control:focus {
    border-color: #86b7fe;
    }
    </style>