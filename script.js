/**
 * Copy all navigational links into a single mobile menu.
 */
jQuery(function () {
    jQuery("html").removeClass("no-js").addClass("js");

    if (!jQuery("#page-container").length) {
        return;
    }

    var menuLabel = jQuery("body").attr("data-vector-menu-label") || "Menu";

    var $mobilemenu = jQuery("<div>")
        .attr("id", "vector__mobile-menu")
        .attr("role", "navigation")
        .attr("aria-label", menuLabel)
        .attr("aria-hidden", "true")
        .addClass("mobile-menu");

    var $logo = jQuery("#p-logo")
        .clone()
        .removeAttr("id")
        .find("[accesskey]").removeAttr("accesskey").end()
        .addClass("mobile-logo");
    $logo.find("[title]").each(function () {
        var $link = jQuery(this);
        var title = $link.attr("title") || "";

        if (/^\[ALT\+/i.test(title)) {
            $link.removeAttr("title");
        }
    });

    var $search = jQuery("#p-search form")
        .clone()
        .removeAttr("id")
        .removeAttr("name")
        .addClass("mobile-search");
    if ($search.length) {
        var searchLabel = $search.find("button").attr("title") ||
            $search.find("#qsearch__in").attr("placeholder") ||
            "Search";

        $search.find("#simpleSearch").removeAttr("id");
        $search.find("label[for=\"qsearch__in\"]").removeAttr("for");
        $search.find("#qsearch__in")
            .attr("aria-label", searchLabel)
            .removeAttr("id")
            .removeAttr("accesskey");
        $search.find("#searchButton")
            .removeAttr("id")
            .text(searchLabel);
        $search.find("#qsearch__out").remove();

        $mobilemenu.append($search);

    }
    jQuery([
        "p-navigation",
        "left-navigation",
        "right-navigation",
        "p-coll-print_export",
        "p-tb",
        "p-personal"
    ]).each(function (i, name) {
        var filter = "#" + name + " li";
        var $items = jQuery(filter)
            .not(".selected")
            .clone()
            .removeAttr("id");
        $items.find("[id]").removeAttr("id");
        $items.find("[accesskey]").each(function () {
            var $link = jQuery(this);
            var title = $link.attr("title") || "";

            $link.removeAttr("accesskey");
            if (/^\[ALT\+/i.test(title)) {
                $link.removeAttr("title");
            }
        });
        if (!$items.length) {
            return;
        }

        var ul = jQuery("<ul>")
            .addClass("mobile-" + name)
            .append($items);
        $mobilemenu.append(ul);
    });

    var $hamburger = jQuery("<button>")
        .attr("type", "button")
        .attr("aria-controls", "vector__mobile-menu")
        .attr("aria-expanded", "false")
        .attr("aria-label", menuLabel)
        .addClass("mobile-hamburger");

    function setMobileMenuOpen(opened, restoreFocus) {
        jQuery("body").toggleClass("mobile-menu-open", opened);
        $mobilemenu
            .toggleClass("open", opened)
            .attr("aria-hidden", opened ? "false" : "true");
        $hamburger
            .toggleClass("open", opened)
            .attr("aria-expanded", opened ? "true" : "false");

        if (!opened && restoreFocus) {
            $hamburger.trigger("focus");
        }
    }

    $hamburger.click(function (event) {
        event.stopPropagation();
        setMobileMenuOpen(!$mobilemenu.hasClass("open"), false);
    });

    $mobilemenu.click(function (event) {
        event.stopPropagation();
    });

    $mobilemenu.on("click", "a", function () {
        setMobileMenuOpen(false, false);
    });

    jQuery(document)
        .on("keydown.vectorMobileMenu", function (event) {
            if (!$mobilemenu.hasClass("open")) {
                return;
            }
            if (event.key === "Escape" || event.key === "Esc" || event.which === 27) {
                setMobileMenuOpen(false, true);
            }
        })
        .on("click.vectorMobileMenu", function () {
            if ($mobilemenu.hasClass("open")) {
                setMobileMenuOpen(false, false);
            }
        });

    var $skiplink = jQuery("body > .skiplink").first();
    if ($skiplink.length) {
        $skiplink.after([$logo, $hamburger, $mobilemenu]);
    } else {
        jQuery("#page-container").before([$logo, $hamburger, $mobilemenu]);
    }
});
