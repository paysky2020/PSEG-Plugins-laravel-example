<button type="button" class="btn btn-info" id="Moamalat_payment_id" onclick="showLightBox()">{{__('moamalat.paybtn')}}</button>

@isset($payment)

    @if (env('Moamalat_Enviroment') == 'production')
        <script src="https://npg.moamalat.net:6006/js/lightbox.js"></script>
    @else
        <script src="https://tnpg.moamalat.net:6006/js/lightbox.js"></script>
    @endif


    <script type="text/javascript">
        function showLightBox() {
            Lightbox.Checkout.configure = {
                paymentMethodFromLightBox: "{{ $payment['paymentMethodFromLightBox'] }}",
                MID: "{{ $payment['MID'] }}",
                TID: "{{ $payment['TID'] }}",
                AmountTrxn: "{{ $payment['AmountTrxn'] }}",
                MerchantReference: "{{ $payment['MerchantReference'] }}",
                TrxDateTime: "{{ $payment['TrxDateTime'] }}",
                SecureHash: "{{ $payment['SecureHash'] }}",
                completeCallback: function(data) {
                    var url = "{{ route('moamalat.payment.completeCallback') }}";
                    url += "?refNumber={{ $payment['MerchantReference'] }}";
                    url += "&TxnNumber=" + data.SystemReference;
                    window.location.href = url;

                },
                errorCallback: function(data) {
                    var url = "{{ route('moamalat.payment.errorCallback') }}";
                    url += "?refNumber={{ $payment['MerchantReference'] }}";
                    window.location.href = url;
                },
                cancelCallback: function() {
                    console.log('cancel');
                }
            };

            Lightbox.Checkout.showLightbox();
        }
    </script>
@endisset
