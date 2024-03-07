<?php

namespace App\Http\Controllers;

use Braintree;
use Braintree\Gateway;
use App\Http\Requests\Braintree\BraintreeRequest;


class BraintreeController extends Controller
{
    // Funzione per generare un token client per l'interfaccia utente Drop-in di Braintree
    public function generateClientToken()
    {
        // Creo una connessione al gateway Braintree usando le mie credenziali configurate
        $gateway = new Braintree\Gateway(config('services.braintree'));

        // Genero un token client per una comunicazione sicura con Braintree
        $clientToken = $gateway->clientToken()->generate();

        // Restituisco il token generato come risposta JSON
        return response()->json(['token' => $clientToken]);
    }

    // Funzione per elaborare un pagamento
    public function processPayment(BraintreeRequest $request, Gateway $gateway)
    {
        // Creo un'istanza del gateway Braintree per l'elaborazione del pagamento
        $gateway = new Braintree\Gateway(config('services.braintree'));

        // Estraggo il nonce del metodo di pagamento dalla richiesta
        $paymentMethodNonce = $request->payment_method_nonce;

        // Tento di elaborare il pagamento
        $result = $gateway->transaction()->sale([
            'amount' => '10.00', // Importo di esempio, da sostituire con il valore dinamico
            'paymentMethodNonce' => $paymentMethodNonce,
            'options' => ['submitForSettlement' => True], // Invia immediatamente il pagamento
        ]);

        // Gestisco il risultato della transazione
        if ($result->success) {
            // Il pagamento ha avuto successo!
            // Restituisco un messaggio di successo e l'ID transazione
            return response()->json([
                'success' => true,
                'transaction_id' => $result->transaction->id
            ]);
        } else {
            // Il pagamento è fallito :(
            // Restituisco un messaggio di errore
            return response()->json([
                'success' => false,
                'message' => 'Pagamento fallito'
            ]);
        }
    }
}
