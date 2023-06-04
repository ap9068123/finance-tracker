document.addEventListener("DOMContentLoaded", function() {
    const transactionList = document.getElementById("transaction-list");
    const transactionForm = document.getElementById("transaction-form");
    const descriptionInput = document.getElementById("description");
    const amountInput = document.getElementById("amount");
    const totalAmountElement = document.getElementById("total-amount");
    const expense= document.getElementById("expense");

    let transactions = [];

    // Load transactions from local storage
    if (localStorage.getItem("transactions")) {
        transactions = JSON.parse(localStorage.getItem("transactions"));
        renderTransactions();
    }

    // Add transaction
    transactionForm.addEventListener("submit", function(e) {
        e.preventDefault();

        const description = descriptionInput.value.trim();
        const amount = parseFloat(amountInput.value.trim());

        if (description !== "" && !isNaN(amount)) {
            const transaction = {
                id: Date.now(),
                description: description,
                amount: amount
            };

            transactions.push(transaction);
            saveTransactions();
            renderTransactions();

            descriptionInput.value = "";
            amountInput.value = "";
        }
    });

    // Edit transaction
    function editTransaction(id) {
        const transaction = transactions.find(t => t.id === id);
        if (transaction) {
            const newDescription = prompt("Enter a new description:", transaction.description);
            const newAmount = parseFloat(prompt("Enter a new amount:", transaction.amount));

            if (newDescription !== null && newDescription.trim() !== "") {
                transaction.description = newDescription.trim();
            }
            if (!isNaN(newAmount)) {
                transaction.amount = newAmount;
            }

            saveTransactions();
            renderTransactions();
        }
    }

    // Delete transaction
    function deleteTransaction(id) {
        transactions = transactions.filter(t => t.id !== id);
        saveTransactions();
        renderTransactions();
    }

    // Save transactions to local storage
    function saveTransactions() {
        localStorage.setItem("transactions", JSON.stringify(transactions));
    }

    // Render transactions
    function renderTransactions() {
        transactionList.innerHTML = "";

        transactions.forEach(transaction => {
            const transactionItem = document.createElement("div");
            transactionItem.classList.add("transaction-item");

            const transactionText = document.createElement("div");
            transactionText.innerHTML = `
                <p>${transaction.description}</p>
                <p>${transaction.amount}</p>
            `;

            const transactionActions = document.createElement("div");
            transactionActions.innerHTML = `
                <button onclick="editTransaction(${transaction.id})" style="background-color:#d4ac0d;">Edit</button>
                <button onclick="deleteTransaction(${transaction.id})">Delete</button>
            `;

            transactionItem.appendChild(transactionText);
            transactionItem.appendChild(transactionActions);
            transactionList.appendChild(transactionItem);
        });

        const totalAmount = transactions.reduce((total, transaction) => total + transaction.amount, 0);
        totalAmountElement.textContent = totalAmount.toFixed(2);
    }
});
