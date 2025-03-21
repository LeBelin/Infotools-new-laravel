<div>
    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Commande ajoutée avec succès !" />
        <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="create-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une commande</flux:heading>
                <flux:subheading>Remplissez le formulaire pour ajouter une commande !</flux:subheading>
            </div>

            <!-- Sélecteur de client -->
            <div>
                <label for="client_id">Client concerné</label>
                <select wire:model="client_id" id="client_id" class="form-select">
                    <option value="">Sélectionner un client</option>
                    @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Sélecteur de produit -->
            <div>
                <label for="produit_id">Produit concerné</label>
                <select wire:model="produit_id" id="produit_id" class="form-select">
                    <option value="">Sélectionner un produit</option>
                    @foreach($produits as $produit)
                        <option value="{{ $produit->id }}" data-prix="{{ $produit->prix }}">{{ $produit->nom_produit }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Quantité -->
            <div>
                <label for="quantite">Quantité</label>
                <input type="number" id="quantite" class="form-input" placeholder="Quantité" min="1" value="1" wire:model="quantite" />
            </div>

            <!-- Montant (calcule automatiquement en live avec JavaScript) -->
            <div>
                <label for="montant">Montant</label>
                <input type="text" id="montant" class="form-input" placeholder="Montant" readonly wire:model="montant" />
            </div>

            <div class="flex">
                <flux:spacer />
                <!-- Utilisez wire:click sur le bouton pour appeler la méthode submit -->
                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter la commande</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

<!-- Script JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const quantiteInput = document.getElementById("quantite");
        const montantInput = document.getElementById("montant");
        const produitSelect = document.getElementById("produit_id");

        let prixProduit = 0;

        // Fonction pour mettre à jour le prix produit lorsqu'un produit est sélectionné
        produitSelect.addEventListener("change", function() {
            const selectedOption = produitSelect.options[produitSelect.selectedIndex];
            prixProduit = parseFloat(selectedOption.getAttribute("data-prix"));
            updateMontant();
        });

        // Fonction pour mettre à jour le montant
        function updateMontant() {
            const quantite = parseFloat(quantiteInput.value);
            
            if (!isNaN(quantite) && !isNaN(prixProduit)) {
                const montant = quantite * prixProduit;
                montantInput.value = montant.toFixed(2); // Mettre à jour le montant avec 2 décimales
            }
        }

        // Mettre à jour le montant lorsque la quantité change
        quantiteInput.addEventListener("input", updateMontant);

        // Initialiser le montant au chargement de la page
        updateMontant();
    });
</script>
