<!DOCTYPE html>
<html>

<head>
    <title>Laravel 10 - Stripe Payment Gateway Integration Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>

 <div style="margin-top: 5%">
    <div class=" col-xs-offset-4 col-xs-4">

        <div class="panel panel-primary">
            <div class="panel-body">
                <h1
                    class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-6 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">
                    Make A Payment</h1>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <form action="{{ route('stripe.post') }}" method="POST" id="card-form">
                    @csrf
                    <div class="form-group">
                        <label for="card-name" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Your
                            name</label>
                        <input type="text" name="name" id="card-name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email"
                            class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card
                            details</label>

                        <div class="bg-gray-100 p-6 rounded-xl">
                            <div id="card" class="form-control"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Pay 👉</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>

</body>


<script>
    let stripe = Stripe('{{ env('STRIPE_KEY') }}')
    const elements = stripe.elements()
    const cardElement = elements.create('card', {
        style: {
            base: {
                fontSize: '16px'
            }
        }
    })
    const cardForm = document.getElementById('card-form')
    const cardName = document.getElementById('card-name')
    cardElement.mount('#card')
    cardForm.addEventListener('submit', async (e) => {
        e.preventDefault()
        const {
            paymentMethod,
            error
        } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                name: cardName.value
            }
        })
        if (error) {
            console.log(error)
        } else {
            let input = document.createElement('input')
            input.setAttribute('type', 'hidden')
            input.setAttribute('name', 'payment_method')
            input.setAttribute('value', paymentMethod.id)
            cardForm.appendChild(input)
            cardForm.submit()
        }
    })
</script>

</html>
