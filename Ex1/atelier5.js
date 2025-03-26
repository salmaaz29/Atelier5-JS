// Simuler la récupération de données utilisateur après un délai
function fetchUserData() {
    return new Promise((resolve) => {
        setTimeout(() => {
            const userData = {
                name: 'John Doe',
                email: 'johndoe@example.com',
                avatar: 'avatar.png',
                gender: 'M',
                login: 'johndoe123',
                password: 'password123',
                address: '123 Main St, New York, USA'
            };
            resolve(userData);
        }, 2000); // Simulation de délai de 2 secondes
    });
}

// Simuler la récupération des commandes de l'utilisateur
function fetchUserOrders(userId) {
    return new Promise((resolve) => {
        setTimeout(() => {
            const orders = [
                { id: 1, item: 'Laptop', price: 1200 },
                { id: 2, item: 'Smartphone', price: 800 }
            ];
            resolve(orders);
        }, 1500);
    });
}

// Fonction pour afficher le profil utilisateur
async function displayUserProfile() {
    try {
        const user = await fetchUserData();
        document.getElementById('profile').innerHTML = `
            <img src="${user.avatar}" alt="Avatar" width="100">
            <h2>${user.name}</h2>
            <p>Email: ${user.email}</p>
            <p>Gender: ${user.gender}</p>
            <p>Login: ${user.login}</p>
            <p>Address: ${user.address}</p>
        `;

        // Récupérer les commandes de l'utilisateur après l'affichage du profil
        const orders = await fetchUserOrders();
        let orderList = '<h3>Commandes :</h3><ul>';
        orders.forEach(order => {
            orderList += `<li>${order.item} - ${order.price}€</li>`;
        });
        orderList += '</ul>';
        document.getElementById('orders').innerHTML = orderList;

    } catch (error) {
        console.error("Erreur lors du chargement des données:", error);
    }
}

// Affichage des utilisateurs dans un tableau
function displayUsersTable(users) {
    let tableContent = `
        <table border="1">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Login</th>
                <th>Adresse</th>
            </tr>
    `;

    users.forEach(user => {
        tableContent += `
            <tr>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.login}</td>
                <td>${user.address}</td>
            </tr>
        `;
    });

    tableContent += `</table>`;
    document.getElementById('usersTable').innerHTML = tableContent;
}

// Ajouter plusieurs utilisateurs et les afficher
const usersList = [
    {
        name: 'John Doe',
        email: 'johndoe@example.com',
        login: 'johndoe123',
        address: '123 Main St, New York, USA'
    },
    {
        name: 'Jane Smith',
        email: 'janesmith@example.com',
        login: 'janesmith456',
        address: '456 Elm St, Los Angeles, USA'
    },
    {
        name: 'Alice Johnson',
        email: 'alicej@example.com',
        login: 'alicejohnson789',
        address: '789 Pine St, Chicago, USA'
    }
];

// Exécuter l'affichage
displayUserProfile();
displayUsersTable(usersList);
