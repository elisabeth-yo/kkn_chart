<style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }
</style>
<html>
    <table class="center">
        <tr>
            <th colspan="2"><h3>Form Inquiry</h3></th>
        </tr>
        <tr>
            <td>PRODUCT NAME</td>
            <td>{{ isset($inquiryForm['product_name']) ? $inquiryForm['product_name'] : '' }}</td>
        </tr> 
        <tr>
            <td>QUANTITY</td>
            <td>{{ isset($inquiryForm['quantity']) ? $inquiryForm['quantity'] : '' }}</td>
        </tr> 
        <tr>
            <td>DETAIL PRODUCT</td>
            <td>{{ isset($inquiryForm['detail_product']) ? $inquiryForm['detail_product'] : '' }}</td>
        </tr>
        <tr>
            <td>NAME</td>
            <td>{{ isset($inquiryForm['name']) ? $inquiryForm['name'] : '' }}</td>
        </tr> 
        <tr>
            <td>EMAIL</td>
            <td>{{ isset($inquiryForm['email']) ? $inquiryForm['email'] : '' }}</td>
        </tr> 
        <tr>
            <td>PHONE</td>
            <td>{{ isset($inquiryForm['phone']) ? $inquiryForm['phone'] : '' }}</td>
        </tr> 
        <tr>
            <td>BUSINESS NAME</td>
            <td>{{ isset($inquiryForm['business_name']) ? $inquiryForm['business_name'] : '' }}</td>
        </tr> 
        <tr>
            <td>BUSINESS ADDRESS</td>
            <td>{{ isset($inquiryForm['business_address']) ? $inquiryForm['business_address'] : '' }}</td>
        </tr> 
        <tr>
            <td>SHIPPING TERMS</td>
            <td>{{ isset($inquiryForm['shipping_terms']) ? $inquiryForm['shipping_terms'] : '' }}</td>
        </tr> 
    </table>
</html>