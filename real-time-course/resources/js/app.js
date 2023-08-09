import "./bootstrap";

Echo.channel("trades").listen("NewTrade", (data) => {
    console.log(data);
});
