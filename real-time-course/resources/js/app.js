import "./bootstrap";

Echo.channel("trades").listen("NewTrade", (data) => {
    const el = document.getElementById("trade-data");
    console.log(data);
    el.textContent = data.trade;
});
console.log("HIHII");
// import Alpine from "alpinejs";

// window.Alpine = Alpine;

// Alpine.start();

// window.Echo.private(`private-chat`).listen("PrivateMessage", (e) => {
//     console.log(e.message);
// });
