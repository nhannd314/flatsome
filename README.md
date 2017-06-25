# flatsome
Fix flatsome ver 3.3.3

### 1. Menu image:

Mình sử dụng plugin menu image, có custom lại code để phù hợp hơn. Tuy nhiên chưa có thời gian để tích hợp vào theme luôn nên đành tạm thời để tách ra vậy.
Link download:
http://www.mediafire.com/file/13cu6cinh0k4tl0/menu-image.zip

### 2. Phần custome code của theme

Các bạn xem Git sẽ thấy

https://github.com/nhannd314/flatsome/commit/e83473f1cc1676e59ee46a416d1e31e759da0c68
Mình cũng có fix 1 số lỗi của theme như lỗi Google fonts, font-weight, jquery cookie (jquery cookie của flatsome sử dụng từ woocommerce nên nếu bạn nào dựng web mà không cài woocommerce thì sẽ bị lỗi này)

### 3. Phần CSS và JS:

Mình viết css và js trên Customize của theme để tiện chỉnh sửa, mình copy ra đây cho các bạn xem nhé:

- CSS:

```
/** mega menu */

#wide-nav > .flex-row > .flex-left {
    width: 25%;
    min-width: 245px;
    margin-right: 15px;
}

#mega-menu-wrap {
    width: 100%;
    background: #1d71ab;
    position: relative;
}

#mega-menu-title {
    padding: 10px 0 10px 15px;
    font-size: 15px;
    font-family: "Roboto Condensed", sans-serif;
    font-weight: 700;
    color: #fff;
    cursor: pointer
}

#mega-menu-title i {
    margin-right: 9px
}

#mega_menu {
    position: absolute;
    top: 100%;
    margin-top: 20px;
    left: 0;
    width: 100%;
    border: 1px solid #ddd;
    padding: 0;
    background: #fff;
    display: none
}

#header.header.has-sticky .header-wrapper.stuck #mega_menu {
    margin-top: 0;
}

body.home #mega_menu {
    display: block
}

#mega_menu > li {
    position: relative;
    z-index: 8
}

#mega_menu li a {
    padding: 7px 15px;
    display: block;
    font-size: 14px
}

#mega_menu > li > a:after {
    content: "\f105";
    font-family: FontAwesome;
    float: right
}

#mega_menu > li > a {
    position: relative;
    padding-left: 40px
}

#mega_menu > li > a > img {
    position: absolute;
    top: 8px;
    left: 8px
}

#mega_menu > li:hover > a {
    background: #f5f5f5
}

#mega_menu li > .toggle {
    display: none
}

#mega_menu > li > ul.sub-menu {
    position: absolute;
    top: -1px;
    left: 100%;
    background: #fff;
    width: 201%;
    min-height: 334px;
    margin: 0;
    padding: 0;
    border: 1px solid #ccc;
    box-shadow: 0 6px 12px rgba(0, 0, 0, .175)
}

#mega_menu ul.sub-menu > li > a {
    width: 50%
}

#mega_menu ul.sub-menu > li:hover > a {
    background: #f5f5f5
}

#mega_menu ul.sub-menu li a, #mega_menu > li:hover > ul.sub-menu {
    display: block
}

#header.header.has-sticky .header-wrapper.stuck #mega_menu:not(.active) {
    display: none
}

#header.header #mega_menu.active {
    display: block
}

#mega_menu > li > .menu-image {
    position: absolute;
    left: 100%;
    top: 0px;
    display: none;
    width: 200%;
    background: #fff;
    text-align: right;
}

#mega_menu > li > .menu-image > img {
    position: relative;
    z-index: 1;
    max-width: 49%;
    max-height: 330px;
    margin-top: 1px;
}

#mega_menu > li:hover > .menu-image, #mega_menu > li:hover > ul.sub-menu {
    display: block
}

#mega_menu > li:hover > ul.sub-menu:before {
    content: "";
    background: 0 0;
    position: absolute;
    top: -1px;
    bottom: 0;
    width: 15px;
    left: -15px
}

#mega_menu ul.sub-menu > li {
    position: relative
}

#mega_menu ul.sub-menu > li > .menu-image {
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    min-height: 240px;
    background: #fff;
    text-align: right;
    display: none;
    z-index: 2
}

#mega_menu ul.sub-menu > li > .menu-image > img {
    width: 100%
}

#mega_menu ul.sub-menu > li:hover > .menu-image {
    display: block
}
```

- Javascript:

```
<script>
jQuery(document).ready(function () {
    jQuery("#mega-menu-title").click(function () {

        jQuery("#mega_menu").toggleClass("active")

    }),
    jQuery("body").click(function (e) {

        var i = jQuery(e.target);
        "mega-menu-title" != i.attr("id") && jQuery("#mega_menu.active").removeClass("active")

    }),
    jQuery("#mega_menu>li").each(function (e) {

        jQuery(this).children(".sub-menu").css("margin-top", 37 * -e + "px"), jQuery(this).children(".menu-image").css("margin-top", 37 * -e + "px"), jQuery(this).find("li").each(function (e) {
            jQuery(this).children(".menu-image").css("margin-top", 36 * -e + "px")
        })

    })

});
</script>
```

** Mình đang vướng dự án nên không thể viết chi tiết hơn được, mong các bạn thông cảm. Hy vọng mọi người có thể đóng góp, hoàn thiện hơn để chia sẻ vì 1 cộng đồng tích cực!
