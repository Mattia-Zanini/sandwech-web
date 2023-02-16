<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <h1>Order</h1>
            <button class="btn btn-primary"
                onclick="window.location.href = 'http://localhost/sandwech-web/'">Back</button>
        </div>
        <div class="col-9">
            <div id="myDiv"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script text="text/javascript">
$(document).ready(function() {
    var cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
    console.log(cookieUserData);
    GetArchieveTags();

    /*
    console.log(Math.floor(17 / 4));
    console.log(Math.floor(4.9));
    */
});

function GetArchieveTags() {
    $.ajax({
        url: "/food-api/API/tag/getArchiveTag.php",
        type: "GET",
        success: function(data) {
            console.log(data);
            RenderTagsItems(data);
        },
        error: function(request, status, error) {}
    });
}

function GetProductsByTag(tagName) {}

function RenderTagsItems(tags) {
    let tagsDiv = new HItem(
        "div", {
            class: 'row',
            id: "myDivRow"
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

    $(".btn-tag").click(function() {
        //console.log("clicked " + $(this).attr('id'));
        console.log("clicked " + $(this).text());
    });
}
</script>

<?php get_footer(); ?>