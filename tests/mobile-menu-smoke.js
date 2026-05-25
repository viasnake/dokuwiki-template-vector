const fs = require("fs");
const { JSDOM } = require("jsdom");

const htmlFile = process.argv[2];
const scriptFile = process.argv[3] || "script.js";

if (!htmlFile) {
    throw new Error("Usage: node tests/mobile-menu-smoke.js <rendered-html> [script.js]");
}

const dom = new JSDOM(fs.readFileSync(htmlFile, "utf8"), {
    runScripts: "outside-only",
    url: "http://127.0.0.1:8765/doku.php?id=start"
});
const { window } = dom;

global.window = window;
global.document = window.document;

const jQuery = require("jquery");
window.jQuery = jQuery;
window.$ = jQuery;
window.eval(fs.readFileSync(scriptFile, "utf8"));
window.document.dispatchEvent(new window.Event("DOMContentLoaded", { bubbles: true }));
window.dispatchEvent(new window.Event("load"));

setTimeout(() => {
    try {
        const html = jQuery("html");
        assert(html.hasClass("js") && !html.hasClass("no-js"), "html js/no-js classes were not updated");

        const menu = jQuery("#vector__mobile-menu");
        const button = jQuery(".mobile-hamburger");
        const logo = jQuery(".mobile-logo");
        assert(menu.length === 1, "mobile menu was not inserted");
        assert(button.length === 1, "mobile hamburger was not inserted");
        assert(logo.length === 1, "mobile logo was not inserted");
        assert(menu.attr("aria-hidden") === "true", "mobile menu initial aria-hidden mismatch");
        assert(button.attr("aria-expanded") === "false", "hamburger initial aria-expanded mismatch");
        assert(menu.find("form.mobile-search").length === 1, "mobile search was not cloned");
        assert(menu.find("[id]").length === 0, "mobile menu contains cloned duplicate ids");
        assert(menu.find("[accesskey]").length === 0, "mobile menu contains cloned accesskeys");

        button.trigger("click");
        assert(menu.hasClass("open") && menu.attr("aria-hidden") === "false", "mobile menu did not open");
        assert(button.hasClass("open") && button.attr("aria-expanded") === "true", "hamburger did not open");

        window.document.dispatchEvent(new window.KeyboardEvent("keydown", {
            key: "Escape",
            bubbles: true
        }));
        assert(!menu.hasClass("open") && menu.attr("aria-hidden") === "true", "mobile menu did not close on Escape");
        assert(!button.hasClass("open") && button.attr("aria-expanded") === "false", "hamburger did not close on Escape");
    } catch (error) {
        console.error(error.stack || error.message);
        process.exitCode = 1;
    }
}, 20);

function assert(condition, message) {
    if (!condition) {
        throw new Error(message);
    }
}
