<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <?php require_once("navbar.php"); ?>
    <div class="row">
        <div id="myDiv"></div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/navutils.js"></script>
<script text="text/javascript">
    $(document).ready(function () {
        $(".order-redirect").addClass("current-page");

        var cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
        console.log(cookieUserData);
        GetArchieveTags();
    });

    function GetArchieveTags() {
        $.ajax({
            url: "/food-api/API/tag/getArchiveTag.php",
            type: "GET",
            success: function (data) {
                console.log(data);
                RenderTagsItems(data);
            },
            error: function (request, status, error) { }
        });
    }

    function GetProductsByTag(tagID) {
        $.ajax({
            url: "/food-api/API/tag/product-tag/getActiveProductsByTag.php?tag_id=" + tagID,
            type: "GET",
            success: function (data) {
                console.log(data);

                RenderItems(data);
            },
            error: function (request, status, error) { }
        });
    }

    function RenderTagsItems(tags) {
        let tagsDiv = new HItem(
            "div", {
            class: 'row',
            id: "myDivRow"
        },
            "myDiv");
        let productsDiv = new HItem(
            "div", {
            class: 'row',
            id: "myDivRowProd"
        },
            "myDiv");

        for (let i = 0; i < tags.length; i++) {
            let colBtn = "col-" + i;

            let tagBtnCol = new HItem(
                "div", {
                class: 'col-2',
                id: colBtn
            },
                "myDivRow");

            let tagBtn = new HItem(
                "div", {
                class: 'btn btn-primary btn-tag',
                id: tags[i].id,
                text: tags[i].name
            },
                colBtn);
        }

        $(".btn-tag").click(function () {
            //console.log("clicked " + $(this).attr('id'));
            console.log("clicked " + $(this).text());

            $('.product-box').remove(); //toglie le box degli eventuali prodotti già in visualizzazione

            GetProductsByTag($(this).attr('id'));
        });
    }

    function RenderItems(items) {
        //non serve, basta usare il col-4 di bootstrap per dividerli equamente nelle varie righe
        for (let i = 0; i < items.length; i++) {
            let tagsDiv = new HItem(
                "div", {
                class: "col-3 product-box",
                style: "margin-top: 2vw;",
                id: "item-id-" + items[i].id,
                tag: items[i].tag,
                productID: items[i].id
            },
                "myDivRowProd");

            let item = new HItem(
                "div", {
                style: "background-color: #e0d784; width: 90%; height: 100px;" +
                    "border-radius: 10px; text-align: center;",
                text: items[i].name + "; prezzo: " + items[i].price + "€",
            },
                "item-id-" + items[i].id);
        }

        //console.log("Created items");

        $(".product-box").click(function () {
            //console.log("clicked box with productID: " + $(this).attr('productID'));

            window.location.href = 'http://localhost/sandwech-web/product?productID=' + $(this).attr('productID');
        });
    }
</script>

<?php get_footer(); ?>