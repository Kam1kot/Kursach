function setCookie(name, value, days = 365) {
    document.cookie = `${name}=${encodeURIComponent(value)}; path=/; max-age=${
        days * 24 * 60 * 60
    }`;
}

function getCookie(name) {
    return document.cookie
        .split("; ")
        .find((row) => row.startsWith(name + "="))
        ?.split("=")[1];
}
