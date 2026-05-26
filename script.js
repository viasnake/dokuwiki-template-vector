/**
 * Copy all navigational links into a single mobile menu.
 */
jQuery(function () {
    jQuery("html").removeClass("no-js").addClass("js");
    initVectorAppearance();

    if (!jQuery("#page-container").length) {
        return;
    }

    const menuLabel = jQuery("body").attr("data-vector-menu-label") || "Menu";

    const $mobilemenu = jQuery("<div>")
        .attr("id", "vector__mobile-menu")
        .attr("role", "navigation")
        .attr("aria-label", menuLabel)
        .attr("aria-hidden", "true")
        .addClass("mobile-menu");

    const $logo = jQuery("#p-logo")
        .clone()
        .removeAttr("id")
        .find("[accesskey]").removeAttr("accesskey").end()
        .addClass("mobile-logo");
    $logo.find("[title]").each(function () {
        const $link = jQuery(this);
        const title = $link.attr("title") || "";

        if (/^\[ALT\+/i.test(title)) {
            $link.removeAttr("title");
        }
    });

    const $search = jQuery("#p-search form")
        .clone()
        .removeAttr("id")
        .removeAttr("name")
        .addClass("mobile-search");
    if ($search.length) {
        const searchLabel = $search.find("button").attr("title") ||
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
        "p-toc",
        "left-navigation",
        "right-navigation",
        "p-coll-print_export",
        "p-tb",
        "p-appearance",
        "p-lang",
        "p-personal"
    ]).each(function (i, name) {
        const filter = "#" + name + " li";
        const $items = jQuery(filter)
            .not(".selected")
            .clone()
            .removeAttr("id");
        $items.find("[id]").removeAttr("id");
        $items.find("[accesskey]").each(function () {
            const $link = jQuery(this);
            const title = $link.attr("title") || "";

            $link.removeAttr("accesskey");
            if (/^\[ALT\+/i.test(title)) {
                $link.removeAttr("title");
            }
        });
        if (!$items.length) {
            if (name === "p-appearance") {
                const $appearance = jQuery("#p-appearance [data-vector-appearance]")
                    .first()
                    .clone();
                if ($appearance.length) {
                    $appearance.find("[id]").removeAttr("id");
                    $mobilemenu.append($appearance);
                }
            }
            return;
        }

        const ul = jQuery("<ul>")
            .addClass("mobile-" + name)
            .append($items);
        $mobilemenu.append(ul);
    });

    const $hamburger = jQuery("<button>")
        .attr("type", "button")
        .attr("aria-controls", "vector__mobile-menu")
        .attr("aria-expanded", "false")
        .attr("aria-label", menuLabel)
        .addClass("mobile-hamburger");

    function setMobileMenuOpen(opened, restoreFocus) {
        jQuery("body").toggleClass("vector-mobile-menu-open", opened);
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

    $hamburger.on("click", function (event) {
        event.stopPropagation();
        setMobileMenuOpen(!$mobilemenu.hasClass("open"), false);
    });

    $mobilemenu.on("click", function (event) {
        if (handleMobileAppearanceControl(event.target)) {
            event.stopPropagation();
            return;
        }
        event.stopPropagation();
    });

    jQuery(document)
        .on("keydown.vectorMobileMenu", function (event) {
            if (!$mobilemenu.hasClass("open")) {
                return;
            }
            if (event.key === "Escape") {
                setMobileMenuOpen(false, true);
            }
        })
        .on("click.vectorMobileMenu", function () {
            if ($mobilemenu.hasClass("open")) {
                setMobileMenuOpen(false, false);
            }
        });

    const $skiplink = jQuery("body > .skiplink").first();
    if ($skiplink.length) {
        $skiplink.after([$logo, $hamburger, $mobilemenu]);
    } else {
        jQuery("#page-container").before([$logo, $hamburger, $mobilemenu]);
    }
});

function initVectorAppearance() {
    const storageKey = "modernizedvector.appearance";
    const defaults = {
        text: "standard",
        width: "limited",
        color: "auto"
    };

    function readPreferences() {
        try {
            const parsed = JSON.parse(window.localStorage.getItem(storageKey) || "{}");
            return jQuery.extend({}, defaults, parsed);
        } catch (error) {
            return jQuery.extend({}, defaults);
        }
    }

    function writePreferences(preferences) {
        try {
            window.localStorage.setItem(storageKey, JSON.stringify(preferences));
        } catch (error) {
            // Non-persistent storage is fine; controls still work for this page.
        }
    }

    function applyPreferences(preferences) {
        const body = jQuery("body");
        body
            .removeClass(
                "vector-feature-text-small vector-feature-text-standard vector-feature-text-large " +
                "vector-feature-width-limited vector-feature-width-wide " +
                "vector-feature-color-light vector-feature-color-dark vector-feature-color-auto"
            )
            .addClass("vector-feature-text-" + preferences.text)
            .addClass("vector-feature-width-" + preferences.width)
            .addClass("vector-feature-color-" + preferences.color);

        jQuery("[data-vector-appearance-setting]").each(function () {
            const group = jQuery(this);
            const setting = group.attr("data-vector-appearance-setting");
            const activeValue = preferences[setting];

            group.find("[data-vector-appearance-value]").each(function () {
                const control = jQuery(this);
                control.attr(
                    "aria-pressed",
                    control.attr("data-vector-appearance-value") === activeValue ? "true" : "false"
                );
            });
        });
    }

    const preferences = readPreferences();
    applyPreferences(preferences);

    window.modernizedVectorHandleAppearanceControl = function (controlElement) {
        const control = jQuery(controlElement);
        const group = control.closest("[data-vector-appearance-setting]");
        const setting = group.attr("data-vector-appearance-setting");
        const value = control.attr("data-vector-appearance-value");

        if (!Object.prototype.hasOwnProperty.call(defaults, setting)) {
            return;
        }
        preferences[setting] = value || defaults[setting];
        writePreferences(preferences);
        applyPreferences(preferences);
    };

    jQuery(document).on("click", "[data-vector-appearance-value]", function () {
        window.modernizedVectorHandleAppearanceControl(this);
    });
}

function handleMobileAppearanceControl(target) {
    const control = jQuery(target).closest("[data-vector-appearance-value]");

    if (!control.length ||
        typeof window.modernizedVectorHandleAppearanceControl !== "function") {
        return false;
    }

    window.modernizedVectorHandleAppearanceControl(control[0]);
    return true;
}
