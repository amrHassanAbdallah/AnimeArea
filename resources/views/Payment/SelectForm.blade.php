<div class="form-group col-6" class="text-center" style="border: 4px solid black;padding: 20px;border-radius: 5px">
    <div  style="display: inline-block;float: left" class="input-field col-sm-6">
        <label for="PaymentWay">Credit Card </label>

        <div class="logos" style="display: inline-block">
            <a href="#" class="logos-item">
                <img src="{{asset("app/img/visa.png")}}" alt="Visa">
            </a>
            <a href="#" class="logos-item">
                <img src="{{asset('app/img/mastercard.png')}}" alt="MasterCard">
            </a>
            <a href="#" class="logos-item">
                <img src="{{asset('app/img/discover.png')}}" alt="DISCOVER">
            </a>
            <a href="#" class="logos-item">
                <img src="{{asset('app/img/amex.png')}}" alt="Amex">
            </a>

        </div>
        <input type="radio" name="PaymentWay" value="CreditCard" style="display: inline-block;width: 30px">
    </div>
    <div style="display: inline-block;float: left" class="input-field col-sm-6">
        <label for="PaymentWay">Paypal </label>

        <div class="logos" style="display: inline-block">
            <a href="#" class="logos-item">
                <img width="65" height="45" src="{{asset("app/img/paypal-logo.png")}}" alt="paypal">
            </a>
        </div>
        <input type="radio" name="PaymentWay" value="paypal" style="display: inline-block;width: 30px">
    </div>

    <br>
    <br>


