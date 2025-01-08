document.addEventListener('DOMContentLoaded', function() {
    const cart = {
        items: [],
        
        addItem(name, price, quantity) {
            const existingItem = this.items.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity = quantity;
            } else {
                this.items.push({ name, price, quantity });
            }
            this.updateCart();
        },
        
        updateCart() {
            const cartItems = document.getElementById('cart-items');
            const subtotal = document.getElementById('subtotal-amount');
            
            cartItems.innerHTML = this.items.map(item => `
                <div class="cart-item">
                    <div>${item.name}</div>
                    <div>${item.quantity} x ${item.price.toFixed(2)} €</div>
                </div>
            `).join('');
            
            const total = this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
            subtotal.textContent = total.toFixed(2) + ' €';
        }
    };
    
    // Gestionnaire pour le bouton "Ajouter au panier"
    document.getElementById('add-to-cart').addEventListener('click', function() {
        const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
        selectedProducts.forEach(checkbox => {
            const productItem = checkbox.closest('.product-item');
            const name = productItem.querySelector('h3').textContent;
            const price = parseFloat(productItem.querySelector('.price').textContent);
            const quantity = parseInt(productItem.querySelector('.quantity-input').value);
            
            cart.addItem(name, price, quantity);
        });
    });
    
    // Gestionnaires pour les boutons plus/moins
    document.querySelectorAll('.quantity-control').forEach(control => {
        const input = control.querySelector('.quantity-input');
        
        control.querySelector('.minus').addEventListener('click', () => {
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
            }
        });
        
        control.querySelector('.plus').addEventListener('click', () => {
            input.value = parseInt(input.value) + 1;
        });
        
        // Empêcher les valeurs négatives dans l'input
        input.addEventListener('change', () => {
            if (input.value < 1) input.value = 1;
        });
    });
});
