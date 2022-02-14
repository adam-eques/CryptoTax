<div>
    <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
        <div class="max-w-lg mx-auto text-center">
            <h2 class="text-lg mb-4">
                You have currently <span class="text-primary-100">{{ number_format($credits) }} Credits</span>
            </h2>

            @if($showForm)
                <h2 class="text-lg mb-4">Buy additional credits</h2>

                <div class="mb-4">
                    Number of credits:
                    <select name="price" id="credits-price-id" class="w-full">
                        @foreach($options as $option)
                            <option value="{{ $option->id }}">{{ $option->name_public }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    Name on Card:
                    <input type="text" id="card-holder-name" class="w-full" required value="John Doe">
                </div>

                {{-- Stripe stuff --}}
                <div id="card-element"></div>
                <div id="card-errors" role="alert"></div><br>

                <x-button id="card-button">Pay</x-button>
            @endif
            @if($addedCredits)
                <p>You successfully added <span class="text-primary-100">{{ moneyFormat($addedCredits) }} Credits</span></p>
            @endif
        </div>
    </div>

    @if($showForm)
        <div class="mx-auto my-5 px-3 xs:px-4 xl:max-w-screen-2xl lg:px-5 py-5 bg-white rounded-sm shadow">
            <strong>Test Data: </strong>
            <pre>John Doe</pre>
            <pre>4242 4242 4242 4242 | 12/22 | 123 | 10000</pre>
        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script>
            // const StripeSinglePayment = {
            //
            //
            //     init: function(){
            //
            //     }
            // };
            // StripeSinglePayment.init();

            const stripe = Stripe('{{ env("STRIPE_KEY") }}'),
                priceId = document.getElementById("credits-price-id"),
                elements = stripe.elements(),
                cardElement = elements.create('card'),
                cardHolderName = document.getElementById('card-holder-name'),
                cardButton = document.getElementById('card-button');

            cardElement.mount('#card-element');

            cardButton.addEventListener('click', async (e) => {
                const { paymentMethod, error } = await stripe.createPaymentMethod(
                    'card', cardElement, {
                        billing_details: { name: cardHolderName.value }
                    }
                );

                if (error) {
                    alert(error.message);
                } else {
                    // alert(paymentMethod.id);
                    // createPayment(paymentMethod.id);
                    console.log(paymentMethod.id, priceId.priceId);
                    @this.pay(paymentMethod.id, priceId.value)
                }
            });
        </script>
    @endif
</div>
