@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Nos Produits</h2>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">
                        Tout sélectionner
                    </label>
                </div>
            </div>
            
            @foreach($products as $product)
            <div class="card product-card mb-3">
                <div class="row g-0">
                    <div class="col-md-3">
                        <img src="{{ $product->image }}" class="img-fluid rounded-start product-image" alt="{{ $product->name }}">
                    </div>
                    <div class="col-md-6">
                        <div class="card-body">
                            <h5 class="card-title product-title">{{ $product->name }}</h5>
                            <p class="card-subtitle text-muted">{{ $product->subtitle }}</p>
                            <p class="product-description">{{ $product->description }}</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-body text-end">
                            <p class="product-price fs-4">€{{ number_format($product->price, 2) }}</p>
                            <div class="quantity-control d-flex align-items-center justify-content-end mb-2">
                                <button class="btn btn-outline-secondary btn-sm minus" data-id="{{ $product->id }}">-</button>
                                <input type="number" class="form-control form-control-sm mx-2 quantity-input" value="1" min="1" max="99" style="width: 60px;">
                                <button class="btn btn-outline-secondary btn-sm plus" data-id="{{ $product->id }}">+</button>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input product-checkbox" type="checkbox" 
                                       data-id="{{ $product->id }}" 
                                       data-name="{{ $product->name }}" 
                                       data-price="{{ $product->price }}">
                                <label class="form-check-label">
                                    Ajouter
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div class="cart-panel sticky-top" style="top: 20px;">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Panier</h3>
                        <div id="cart-items"></div>
                        <div class="cart-summary">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Sous-total</span>
                                <span id="subtotal-amount">€0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Réduction</span>
                                <span id="discount-amount" class="text-success">-€0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total</strong>
                                <strong id="total-amount">€0.00</strong>
                            </div>
                            
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Code promo">
                            </div>

                            <form id="checkout-form">
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="customer_name" placeholder="Nom complet" required>
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" name="customer_email" placeholder="Email" required>
                                </div>
                                <div class="mb-3">
                                    <input type="tel" class="form-control" name="customer_phone" placeholder="Téléphone">
                                </div>
                                <div class="mb-3">
                                    <textarea class="form-control" name="shipping_address" placeholder="Adresse de livraison" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100 mb-2" id="checkout-button" disabled>
                                    Envoyer
                                </button>
                                <button type="button" class="btn btn-secondary w-100" id="view-products-btn" data-bs-toggle="modal" data-bs-target="#productsModal">
                                    Voir les produits sélectionnés
                                </button>
                            </form>
                            
                            <p class="text-muted small mt-2 text-center">
                                Commandez avant 14h du lundi au jeudi pour une livraison le lendemain
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Modal -->
<div class="modal fade" id="productsModal" tabindex="-1" aria-labelledby="productsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productsModalLabel">Produits Sélectionnés</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="selected-products-table">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.product-card {
    border: 1px solid #dee2e6;
    transition: all 0.3s ease;
}

.product-card:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.product-image {
    max-height: 200px;
    object-fit: cover;
    padding: 1rem;
}

.cart-panel {
    position: sticky;
    top: 20px;
    max-height: calc(100vh - 40px);
    overflow-y: auto;
}

.cart-item {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.quantity-input {
    text-align: center;
}

.quantity-control button {
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

#cart-items {
    max-height: 200px;
    overflow-y: auto;
    margin-bottom: 1rem;
}

/* Hide scrollbar for Chrome, Safari and Opera */
.cart-panel::-webkit-scrollbar {
    width: 6px;
}

.cart-panel::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.cart-panel::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 3px;
}

/* Hide scrollbar for IE, Edge and Firefox */
.cart-panel {
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}

/* Add some bottom spacing to the main content */
main {
    padding-bottom: 2rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cart = {
        items: [],
        
        addItem(id, name, price, quantity) {
            const existingItem = this.items.find(item => item.id === id);
            if (existingItem) {
                existingItem.quantity = quantity;
            } else {
                this.items.push({ id, name, price, quantity });
            }
            this.updateCart();
        },
        
        removeItem(id) {
            this.items = this.items.filter(item => item.id !== id);
            this.updateCart();
            
            // Uncheck the checkbox
            const checkbox = document.querySelector(`.product-checkbox[data-id="${id}"]`);
            if (checkbox) checkbox.checked = false;
        },
        
        updateCart() {
            const cartItemsContainer = document.getElementById('cart-items');
            const selectedProductsTable = document.getElementById('selected-products-table');
            const subtotalAmount = document.getElementById('subtotal-amount');
            const discountAmount = document.getElementById('discount-amount');
            const totalAmount = document.getElementById('total-amount');
            const checkoutButton = document.getElementById('checkout-button');
            
            cartItemsContainer.innerHTML = '';
            selectedProductsTable.innerHTML = '';
            
            let subtotal = 0;
            
            this.items.forEach(item => {
                // Update cart items
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;
                
                cartItemsContainer.innerHTML += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between">
                            <span>${item.name}</span>
                            <span>€${itemTotal.toFixed(2)}</span>
                        </div>
                        <div class="small text-muted">
                            ${item.quantity} x €${item.price.toFixed(2)}
                        </div>
                    </div>
                `;
                
                // Update modal table
                selectedProductsTable.innerHTML += `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.name}</td>
                        <td>€${item.price.toFixed(2)}</td>
                        <td>${item.quantity}</td>
                        <td>€${itemTotal.toFixed(2)}</td>
                    </tr>
                `;
            });
            
            const discount = subtotal * 0.1; // 10% discount
            const total = subtotal - discount;
            
            subtotalAmount.textContent = `€${subtotal.toFixed(2)}`;
            discountAmount.textContent = `-€${discount.toFixed(2)}`;
            totalAmount.textContent = `€${total.toFixed(2)}`;
            
            checkoutButton.disabled = this.items.length === 0;
        },

        clear() {
            this.items = [];
            this.updateCart();
        }
    };
    
    // Handle quantity controls
    document.querySelectorAll('.quantity-control').forEach(control => {
        const input = control.querySelector('.quantity-input');
        const minus = control.querySelector('.minus');
        const plus = control.querySelector('.plus');
        
        minus.addEventListener('click', () => {
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                updateCartFromCheckbox(control);
            }
        });
        
        plus.addEventListener('click', () => {
            if (input.value < 99) {
                input.value = parseInt(input.value) + 1;
                updateCartFromCheckbox(control);
            }
        });
        
        input.addEventListener('change', () => {
            if (input.value < 1) input.value = 1;
            if (input.value > 99) input.value = 99;
            updateCartFromCheckbox(control);
        });
    });
    
    // Handle product checkboxes
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const productCard = this.closest('.card');
            const quantity = parseInt(productCard.querySelector('.quantity-input').value);
            const id = parseInt(this.dataset.id);
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            
            if (this.checked) {
                cart.addItem(id, name, price, quantity);
            } else {
                cart.removeItem(id);
            }
        });
    });
    
    // Handle "Select All" checkbox
    const selectAllCheckbox = document.getElementById('selectAll');
    selectAllCheckbox.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        cart.clear(); // Clear cart before adding all items
        
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
            if (this.checked) {
                const productCard = checkbox.closest('.card');
                const quantity = parseInt(productCard.querySelector('.quantity-input').value);
                const id = parseInt(checkbox.dataset.id);
                const name = checkbox.dataset.name;
                const price = parseFloat(checkbox.dataset.price);
                cart.addItem(id, name, price, quantity);
            }
        });
    });
    
    function updateCartFromCheckbox(control) {
        const productCard = control.closest('.card');
        const checkbox = productCard.querySelector('.product-checkbox');
        
        if (checkbox.checked) {
            const quantity = parseInt(control.querySelector('.quantity-input').value);
            const id = parseInt(checkbox.dataset.id);
            const name = checkbox.dataset.name;
            const price = parseFloat(checkbox.dataset.price);
            cart.addItem(id, name, price, quantity);
        }
    }
    
    // Handle checkout form submission
    document.getElementById('checkout-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = {
            customer_name: this.customer_name.value,
            customer_email: this.customer_email.value,
            customer_phone: this.customer_phone.value,
            shipping_address: this.shipping_address.value,
            items: cart.items.map(item => ({
                id: item.id,
                quantity: item.quantity,
                price: item.price
            })),
            subtotal: parseFloat(document.getElementById('subtotal-amount').textContent.replace('€', '')),
            discount: parseFloat(document.getElementById('discount-amount').textContent.replace('-€', '')),
            total: parseFloat(document.getElementById('total-amount').textContent.replace('€', ''))
        };
        
        try {
            const response = await fetch('{{ route("orders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert(`Commande passée avec succès! Votre numéro de commande est ${result.order_number}`);
                cart.clear();
                this.reset();
                document.querySelectorAll('.product-checkbox').forEach(checkbox => {
                    checkbox.checked = false;
                });
                selectAllCheckbox.checked = false;
            } else {
                alert('Échec de la commande. Veuillez réessayer.');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Une erreur est survenue. Veuillez réessayer.');
        }
    });
    
    // Handle cart item removal
    document.getElementById('cart-items').addEventListener('click', function(e) {
        if (e.target.closest('.remove-item')) {
            const id = parseInt(e.target.closest('.remove-item').dataset.id);
            cart.removeItem(id);
        }
    });
});
</script>
@endpush
