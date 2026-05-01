<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryan's Coffee and Pastries</title>
    <style>
        :root {
            --bg: #f6f0e8;
            --surface: #fffaf3;
            --surface-strong: #ffffff;
            --ink: #2b2118;
            --muted: #6e5b4c;
            --accent: #8c4b2f;
            --accent-dark: #5f2d18;
            --border: #dfcdbd;
            --shadow: 0 14px 40px rgba(61, 39, 24, 0.12);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--ink);
            background:
                radial-gradient(circle at top left, rgba(222, 189, 154, 0.35), transparent 26%),
                linear-gradient(180deg, #f3e2cf 0%, var(--bg) 42%, #efe4d8 100%);
            min-height: 100vh;
        }

        a {
            color: var(--accent-dark);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .shell {
            max-width: 1160px;
            margin: 0 auto;
            padding: 32px 20px 48px;
        }

        .hero {
            background: linear-gradient(135deg, rgba(255, 250, 243, 0.92), rgba(245, 227, 208, 0.94));
            border: 1px solid rgba(140, 75, 47, 0.12);
            border-radius: 24px;
            padding: 28px;
            box-shadow: var(--shadow);
            margin-bottom: 28px;
        }

        .hero h1 {
            margin: 0 0 10px;
            font-size: clamp(2rem, 3vw, 3rem);
        }

        .hero p {
            margin: 0;
            color: var(--muted);
            max-width: 720px;
            line-height: 1.6;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .card {
            background: var(--surface-strong);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .meta {
            color: var(--muted);
            font-size: 0.95rem;
        }

        .price {
            font-size: 1.2rem;
            font-weight: 700;
            margin: 14px 0 6px;
        }

        .btn {
            display: inline-block;
            background: var(--accent);
            color: #fff;
            padding: 10px 14px;
            border-radius: 999px;
            font-weight: 700;
            margin-top: 12px;
        }

        .btn:hover {
            background: var(--accent-dark);
            text-decoration: none;
        }

        .btn-secondary {
            background: transparent;
            color: var(--accent-dark);
            border: 1px solid var(--border);
        }

        .btn-danger {
            background: #9f3f34;
        }

        .btn-danger:hover {
            background: #7c2f27;
        }

        .section-title {
            margin: 0 0 16px;
            font-size: 1.5rem;
        }

        .stack {
            display: grid;
            gap: 16px;
        }

        .review {
            padding: 16px;
            border-radius: 16px;
            border: 1px solid var(--border);
            background: var(--surface);
        }

        .review strong {
            display: inline-block;
            margin-bottom: 6px;
        }

        .stars {
            color: #bf7b1f;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .pagination-wrap {
            margin-top: 24px;
        }

        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pagination-status {
            color: var(--muted);
            font-weight: 700;
        }

        .pagination-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 14px;
            border-radius: 999px;
            border: 1px solid var(--border);
            background: var(--surface-strong);
            color: var(--accent-dark);
            font-weight: 700;
            box-shadow: var(--shadow);
        }

        .pagination-link:hover {
            text-decoration: none;
            background: #f1e2d4;
        }

        .pagination-link.is-disabled {
            opacity: 0.45;
            pointer-events: none;
        }

        .detail-layout {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 24px;
        }

        .pill {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            background: #f1e2d4;
            color: var(--accent-dark);
            margin-right: 8px;
            margin-bottom: 8px;
        }

        .toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 18px;
        }

        .action-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 14px;
        }

        .inline-form {
            display: inline;
        }

        .form-card {
            max-width: 760px;
        }

        .form-grid {
            display: grid;
            gap: 16px;
        }

        .form-field label {
            display: block;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .form-field input,
        .form-field textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid var(--border);
            border-radius: 14px;
            font: inherit;
            color: var(--ink);
            background: var(--surface);
        }

        .form-field textarea {
            min-height: 140px;
            resize: vertical;
        }

        .flash-message,
        .error-box {
            border-radius: 16px;
            padding: 14px 16px;
            margin-bottom: 18px;
        }

        .flash-message {
            background: #e7f5e8;
            border: 1px solid #b8d8bb;
            color: #24522d;
        }

        .error-box {
            background: #fceaea;
            border: 1px solid #e7b8b8;
            color: #7a2d2d;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 18px;
        }

        @media (max-width: 800px) {
            .detail-layout {
                grid-template-columns: 1fr;
            }

            .hero,
            .card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <section class="hero">
            <h1>Ryan's Coffee and Pastries</h1>
            <p>
                Laravel Eloquent demo: models, relationships, and product pagination.
            </p>
        </section>

        @if (session('status'))
            <div class="flash-message">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-box">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
