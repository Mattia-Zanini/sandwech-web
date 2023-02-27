<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <?php require_once("navbar.php"); ?>
    <div class="row">
        <div class="col-3">
            <select id="pickupSelector">
                <option disabled selected value data-value="-1"> -- select an option -- </option>
                <!-- 
                    <option value="volvo">Volvo</option>
                    <option value="saab">Saab</option>
                    <option value="opel">Opel</option>
                    <option value="audi">Audi</option>
                    -->
            </select>
        </div>
        <div class="col-3">
            <select id="breakSelector">
                <option disabled selected value data-value="-1"> -- select an option -- </option>
            </select>
        </div>
        <div class="col-3" style="text-align: center;">
            <h1>Totale</h1>
            <h4 id="total-price">0,00€</h4>
        </div>
        <div class="col-2">
            <button class="btn btn-warning btn-complete">Completa Ordine</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/navutils.js"></script>
<script text="text/javascript">
    var cookieUserData = null;
    var products = null;

    $(document).ready(function () {
        $('#pickupSelector').change(function () {
            //Use $option (with the "$") to see that the variable is a jQuery object
            let $option = $(this).find('option:selected');
            //Added with the EDIT
            let value = $option.val(); //to get content of "value" attrib
            let text = $option.text(); //to get <option>Text</option> content
            let pickID = $option.attr("data-value");

            console.log(text);
            console.log(pickID);

            $("#breakSelector").empty();
            HItem.Append("breakSelector", {
                type: "option",
                options: {
                    disabled: "disabled",
                    text: " -- select an option -- ",
                    "data-value": -1
                }
            });

            GetBreaksIDByPickup(pickID);
        });

        $('.btn-complete').click(function () {
            let selected = $('#pickupSelector').find('option:selected').attr("data-value");
            console.log(selected);

            if (selected != -1) {
                /*{
                    "user": 1,
                    "break": 1,
                    "status": 1,
                    "pickup": 1,
                    "json": "",
                    "products": [{
                            "ID": 2
                        },
                        {
                            "ID": 1
                        }
                    ]
                }
                /*/
            }
        });

        cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
        console.log(cookieUserData);
        GetUserCart(cookieUserData["userID"], false);
    });

    function GetUserCart(userID) {
        $.ajax({
            url: "/food-api/API/cart/getCart.php?user=" + userID,
            type: "GET",
            success: function (data) {
                console.log(data);
                products = data;

                RenderTotalPrice(data);
                GetPickupPoints();
            },
            error: function (request, status, error) { }
        });
    }

    function RenderTotalPrice(data) {
        let total = 0.00;
        for (let i = 0; i < data.length; i++) {
            let singleItemTotal = data[i].quantity * data[i].price;
            total += singleItemTotal;
        }

        totalString = parseFloat(total).toFixed(2).replace(".", ",");
        //console.log(totalString);
        $("#total-price").text(totalString + "€");
    }

    function GetPickupPoints() {
        $.ajax({
            url: "/food-api/API/order/pickup/getPickup.php",
            type: "GET",
            success: function (data) {
                console.log(data);

                let pickupOptions = [];
                for (let i = 0; i < data.length; i++) {
                    pickupOptions.push([
                        "option", {
                            value: data[i].name,
                            text: data[i].name,
                            "data-value": data[i].id
                        }
                    ]);
                }
                HItem.AppendArray("pickupSelector", pickupOptions);
            },
            error: function (request, status, error) { }
        });
    }

    function GetBreaksIDByPickup(pickupID) {
        $.ajax({
            url: "/food-api/API/order/pickup/getPickupIdBreak.php?PICKUP_ID=" + pickupID,
            type: "GET",
            success: function (data) {
                //console.log(data);

                for (let i = 0; i < data.length; i++) {
                    GetBreakInfo(data[i]);
                }
            },
            error: function (request, status, error) { }
        });
    }

    function GetBreakInfo(breakData) {
        $.ajax({
            url: "/food-api/API/order/break/getBreak.php?BREAK_ID=" + breakData.break,
            type: "GET",
            success: function (data) {
                console.log(data);

                HItem.Append("breakSelector", {
                    type: "option",
                    options: {
                        value: data[0].time,
                        text: data[0].time,
                        "data-value": data[0].id
                    }
                });
            },
            error: function (request, status, error) { }
        });
    }
</script>

<?php get_footer(); ?>