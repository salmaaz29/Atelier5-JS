<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un produit</title>
    <style>
    :root {
        --primary: #4361ee;
        --primary-light: #4895ef;
        --secondary: #3f37c9;
        --danger: #f72585;
        --light: #f8f9fa;
        --dark: #212529;
        --gray: #6c757d;
        --border-radius: 8px;
        --box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease-in-out;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fa;
        color: var(--dark);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        flex-direction: column;
        padding: 20px;
    }

    h1 {
        color: var(--primary);
        font-size: 2rem;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-container {
        background: white;
        padding: 25px;
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        width: 400px;
        text-align: center;
        transition: var(--transition);
    }

    .form-container:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        text-align: left;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: var(--secondary);
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid var(--gray);
        border-radius: var(--border-radius);
        font-size: 16px;
        transition: var(--transition);
    }

    input:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 5px rgba(67, 97, 238, 0.5);
    }

    button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: var(--border-radius);
        font-size: 16px;
        cursor: pointer;
        background-color: var(--primary);
        color: white;
        transition: var(--transition);
    }

    button:hover {
        background-color: var(--primary-light);
        transform: translateY(-2px);
    }

    .back-link {
        display: block;
        text-align: center;
        margin-top: 15px;
        text-decoration: none;
        background-color: var(--gray);
        color: white;
        padding: 10px;
        border-radius: var(--border-radius);
        transition: var(--transition);
        width: 100%;
    }

    .back-link:hover {
        background-color: var(--dark);
        transform: translateY(-2px);
    }

    @media (max-width: 480px) {
        .form-container {
            width: 90%;
        }
    }
</style>

</head>
<body>
    <h1>Ajouter un produit</h1>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div>
            <label>Nom du produit:</label>
            <input type="text" name="product_name" required>
        </div>
        <div>
            <label>Quantité:</label>
            <input type="number" name="quantity" required min="0">
        </div>
        <button type="submit">Ajouter</button>
    </form>
    <a href="{{ route('stocks.index') }}">Retour</a>
</body>
</html>