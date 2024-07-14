<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment Form</title>
</head>
<body>
    <h1>Redirecting to eSewa Payment...</h1>
  

    <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
        <input hidden type="text" id="amount" name="amount" value="{{$amount}}" required>
        <input hidden type="text" id="tax_amount" name="tax_amount" value="{{$tax_amount}}" required>
        <input hidden  type="text" id="total_amount" name="total_amount" value="{{$total_amount}}" required>
        <input hidden type="text" id="transaction_uuid" name="transaction_uuid" value="{{$transaction_uuid}}" required>
        <input hidden type="text" id="product_code" name="product_code" value="{{$product_code}}" required>
        <input hidden  type="text" id="product_service_charge" name="product_service_charge" value="0" required>
        <input hidden type="text" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input hidden  type="text" id="success_url" name="success_url" value="{{$success_url}}" required>
        <input hidden type="text" id="failure_url" name="failure_url" value="{{$failure_url}}" required>
        <input hidden  type="text" id="signed_field_names" name="signed_field_names" value="{{$signed_field_names}}" required>
        <input hidden  type="text" id="signature" name="signature" value="{{$signature}}" required>
        <input hidden value="Submit" type="submit">
    </form>


     <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.forms[0].submit();
        });
    </script>
</body>
</html>
