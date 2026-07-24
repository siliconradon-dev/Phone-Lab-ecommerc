<!DOCTYPE html>
<html>

<head>
    <title>Redirecting to Koko...</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://malsup.github.io/jquery.blockUI.js"></script>
</head>

<body>
    <form action="{{ $url }}" method="post" id="koko_payment_form">
        {{-- Laravel Loop for hidden fields --}}
        @foreach ($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div style="text-align: center; margin-top: 50px;">
            <input type="submit" class="button-alt" id="submit_koko_payment_form" value="Proceed to Payment" />
            <a class="button cancel" href="{{ route('payment.cancel') }}">Cancel</a>
        </div>
    </form>

    <script type="text/javascript">
        jQuery(function() {
            // Block the UI immediately on load
            jQuery("body").block({
                message: 'Thanks for your order! Redirecting to Koko Payment Gateway...',
                overlayCSS: {
                    background: "#fff",
                    opacity: 0.8
                },
                css: {
                    padding: '20px',
                    textAlign: "center",
                    color: "#333",
                    border: "1px solid #eee",
                    backgroundColor: "#fff",
                    cursor: "wait",
                    lineHeight: "32px",
                    fontFamily: "sans-serif"
                }
            });

            // Automatically submit the form after blocking the UI
            setTimeout(function() {
                jQuery("#koko_payment_form").submit();
            }, 500); // 500ms delay to let the user see the message
        });
    </script>
</body>

</html>
